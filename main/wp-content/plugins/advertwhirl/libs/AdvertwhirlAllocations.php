<?php
/*
Copyright 2011  Mobile Sentience LLC  (email : oss@mobilesentience.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
                                                                 
*/

require_once('Version.php');

if(!function_exists('VerifyRuleset')){
	require_once('AdvertwhirlRules.php');

	function VerifyRuleset($set, $allocation, $campaign){
		if(isset($set)){
			if(isset($set['rules'])){
				foreach($set['rules'] as $id => $rule){
					$func = "VerifyRule_" . $rule['type'];
					if(!function_exists($func) || !call_user_func($func, $rule, $allocation, $campaign)){
						return false;
					}
				}
				return true;
			}
			return true;
		}
		return false;
	}
}


if(!function_exists('VerifyAllocation')){
	function VerifyAllocation($allocation, $campaign){
		if(isset($allocation)){
			if(isset($allocation['rulesets'])){
				foreach($allocation['rulesets'] as $id =>  $set){
					if(VerifyRuleset($set, $allocation, $campaign)){
						return true;
					}
				}
				return false;
			}
			return true;
		}
		return false;
	}
}

if(!function_exists('AllocateAd')){
	function AllocateAd($campaign, $index, $allocation){
		global $advertwhirl_stats_name;
		global $advertwhirl_options_name;
		global $wp_version;
		$options = maybe_unserialize(get_option($advertwhirl_options_name));

		$stats = get_option($advertwhirl_stats_name);
		if(!is_array($stats))
			$stats = array();

		$size = isset($options['adcampaigns'][$campaign]['adsize'])?$options['adcampaigns'][$campaign]['adsize']:'234x60';
		$adcontent = "";
		if(isset($allocation)){
			//  Get Counts for Served Ads
			if($stats['stats']['sponsor']['weight'] >= 20 && get_option("siteurl") != "http://www.mobilesentience.com"){
				// Serve Sponsor Add
				$adcontent = ServeAd(null, $size);
			}else{
				// Serve one of the ad source ads
				$served = false;
				if(isset($stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'])){
					foreach($stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'] as $j => $weight){
						$w = isset($allocation['ads'][$j]['percent-weight'])?$allocation['ads'][$j]['percent-weight']:$allocation['ads'][$j]['weight'];
						if($weight < $w){
							$adcontent = ServeAd($allocation['ads'][$j]['advertisement'], $size);
							$stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'][$j]++;
							$served = true;
							break;
						}
					}

					if(!$served){
						// Reset weights and serve first
						foreach($stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'] as $j => $weight){
							$stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'][$j] = 0;
						}
						$adcontent = ServeAd($allocation['ads'][0]['advertisement'], $size);
						$stats['stats']['adcampaigns'][$campaign]['allocations'][$index]['sourceweights'][0]++;
					}
				}
			}
		}else if(isset($options['settings']['fillEmptyAllocations']) && $options['settings']['fillEmptyAllocations']){
			$adcontent = ServeAd($options['settings']['defaultsource'], $size);
		}
		if($stats['stats']['sponsor']['weight'] >= 20){
			$stats['stats']['sponsor']['weight'] = 0;
			$stats['stats']['sponsor']['total'] += 1; /** @todo rotate stats (today, yesterday, this week, last week, this month, last month, all time */
		}else{
			$stats['stats']['sponsor']['weight']++;
		}
		update_option($advertwhirl_stats_name, $stats);
		return $adcontent;
	}
}

if(!function_exists('ServeAd')){
	require_once('AdsenseStats.php');

	function ServeAd($ad = null, $size = '234x60'){
		global $advertwhirl_options_name;
		global $advertwhirl_plugin_name;
		global $advertwhirl_plugin_version;

		$options = maybe_unserialize(get_option($advertwhirl_options_name));

		$adcontent = "";
		if(is_null($ad)){
			$adserv = "http://www.mobilesentience.com/ads/WordpressPlugins&plugin=" . $advertwhirl_plugin_name . "&pluginversion=" . $advertwhirl_plugin_version . '&where=sponsor&size=' . $size . '&site=' . get_option('siteurl') . '&page=' . $_SERVER['REQUEST_URI'];
			$ad = file_get_contents($adserv);
			if($ad !== false){
				$adcontent =  $ad;
			}
		}else if(strpos($ad, 'adsense-') === 0){
			$adsense = new AdsenseStats();
			$unit = $adsense->GetAdUnit(substr($ad, 8));
			$adcontent =  html_entity_decode($unit['code']);
		}else{
			$source = $options['adsources'][$ad];
			switch($source['adtype']){
				case 'url':
					if($source['wrap_url']){
						$adcontent = '<iframe src="' . $source['url'] . '"></iframe>';
					}else{
						$adcontent = $source['url'];
					}
					break;
				case 'inline':
					$adcontent = html_entity_decode($source['code']);
					break;
			}
		}
		return $adcontent;
	}
}

