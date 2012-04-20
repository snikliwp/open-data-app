// JavaScript Document
/**
 * This file contains the functions executed by the application
 *
 * @package:	Gardens
 * @copyright:	March 2012 Pat Wilkins
 * @author:		Pat Wilkins - wilk0146@algonquinlive.com
 * @link:		https://github.com/wilk0146/open-data-app
 * @license:	New BSD License <> See License.txt
 * @version:	See Version.txt
 **/
function setMarker(lat,long,title,id){var myLatlng=new google.maps.LatLng(lat,long);var marker=new google.maps.Marker({position:myLatlng,icon:'images/farm-2.png',animation:google.maps.Animation.DROP,'title':title});marker.setMap(map);google.maps.event.addListener(marker,'click',function(){window.location='single.php?id='+id;});}
function setStars(id,count,response){if(Math.round(response/count)>=1){$('.star1',$('#garden-'+id)).addClass('rated');}
if(Math.round(response/count)>=2){$('.star2',$('#garden-'+id)).addClass('rated');}
if(Math.round(response/count)>=3){$('.star3',$('#garden-'+id)).addClass('rated');}
if(Math.round(response/count)>=4){$('.star4',$('#garden-'+id)).addClass('rated');}
if(Math.round(response/count)>=5){$('.star5',$('#garden-'+id)).addClass('rated');}}
function sortData(ev){ev.preventDefault();var Index=document.getElementById("sortFormID").selectedIndex;var sortName=document.getElementById("sortFormID").options[Index].text;var sortValue=document.getElementById("sortFormID").options[Index].value;if(sortValue=='alpha'){$('.main').load('dataSortAlpha.php');}
if(sortValue=='rate'){$('.main').load('dataSortRate.php');}
if(sortValue=='close'){$('.main').load('dataSortClose.php');}}
function save_cookie(lat,long){if(!$('#adr').val()){navigator.geolocation.getCurrentPosition(function(pos){var date=new Date();date.setTime(date.getTime()+(365*24*60*60*1000));var expires="; expires="+date.toGMTString();document.cookie='location'+"="+pos.coords.latitude+':'+pos.coords.longitude+expires+"; path=/";set_user_location(pos.coords.latitude,pos.coords.longitude);$('.main').load('dataSortClose.php');});}else{var geocoder=new google.maps.Geocoder();geocoder.geocode({address:$('#adr').val()+', Ottawa, ON',region:'CA'},function(results,status){if(status==google.maps.GeocoderStatus.OK){var date=new Date();date.setTime(date.getTime()+(365*24*60*60*1000));var expires="; expires="+date.toGMTString();document.cookie='location'+"="+results[0].geometry.location.lat()+':'+results[0].geometry.location.lng()+"; path=/";set_user_location(results[0].geometry.location.lat(),results[0].geometry.location.lng());$('.main').load('dataSortClose.php');}else{var elmA=document.getElementById('error');var input='That does not seem to be a valid address. Either re-enter the address or take it out completely and let the system identify your location.';elmA.innerHTML=input;}})};}
var userMarker;var userLoc;function set_user_location(){var nameEQ='location=';var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.substring(0,9)==nameEQ){var equal=c.indexOf('=');var colon=c.indexOf(':');var lat=c.substr(equal+1,colon-equal-1);var long=c.substr(colon+1);userLoc=new google.maps.LatLng(lat,long);if(userMarker){userMarker.setPosition(userLoc);}else{userMarker=new google.maps.Marker({position:userLoc,map:map,title:'You are here.',icon:'images/home.png',animation:google.maps.Animation.DROP});userMarker.setMap(map);}
map.setCenter(userLoc);}}
return null;}
$(document).ready(function(){document.getElementById("sortForm").addEventListener("submit",sortData,false);if(navigator.geolocation){$('body').on('click','#geo',function(ev){save_cookie(25,-25);});}});