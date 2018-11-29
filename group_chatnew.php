<?php
session_start();
require_once('includes/config.php');
$member_id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <!-- 
    	The codes are free, but we require linking to our web site.
    	Why to Link?
    	A true story: one girl didn't set a link and had no decent date for two years, and another guy set a link and got a top ranking in Google! 
    	Where to Put the Link?
    	home, about, credits... or in a good page that you want
    	THANK YOU MY FRIEND!
    -->
    <title>Group Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
	
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php require_once('templates/common_css.php');?>

</script>
    <style type="text/css">
    	body{
    background:#eee
}

.ks-page-content{
    margin-top:20px;    
}

.ks-messenger {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    height: 100%
}

.ks-messenger .ks-discussions {
    background: #fff;
    width: 340px;
    border-right: 1px solid #dee0e1
}

.ks-messenger .ks-discussions>.ks-search {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    height: 60px;
    border-bottom: 1px solid #dee0e1
}

.ks-messenger .ks-discussions>.ks-search>.input-icon {
    width: 100%
}

.ks-messenger .ks-discussions>.ks-search .form-control {
    border: none;
    padding: 28px 20px
}

.ks-messenger .ks-discussions>.ks-search .icon-addon {
    color: rgba(58, 82, 155, .6)
}

.ks-messenger .ks-discussions>.ks-body .ks-items {
    list-style: none;
    padding: 0;
    margin: 0
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item {
    border-bottom: 1px solid #dee0e1
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    color: #333;
    padding: 15px 20px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-group-amount {
    position: relative;
    top: 3px;
    margin-right: 12px;
    width: 36px;
    height: 36px;
    background-color: rgba(57, 81, 155, .1);
    text-align: center;
    line-height: 36px;
    -webkit-border-radius: 50%;
    border-radius: 50%
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-group-amount>.ks-badge {
    position: absolute;
    bottom: -1px;
    right: -3px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-avatar {
    position: relative;
    top: 3px;
    margin-right: 12px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-avatar>img {
    width: 36px;
    height: 36px;
    -webkit-border-radius: 50%;
    border-radius: 50%
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-avatar>.ks-badge {
    position: absolute;
    bottom: -3px;
    right: -3px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-body {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-body>.ks-message {
    font-size: 12px;
    color: #858585;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-body>.ks-message>img {
    position: relative;
    top: -2px;
    width: 18px;
    height: 18px;
    margin-right: 5px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-body>.ks-name {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    margin-bottom: 4px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item>a>.ks-body>.ks-name>.ks-datetime {
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 400;
    color: #858585;
    position: relative;
    top: 3px
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-active {
    background: #ebeef5;
    color: #333;
    position: relative
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-active::before {
    content: '';
    width: 4px;
    height: 100%;
    background: #d7dceb;
    display: block;
    position: absolute;
    top: 0;
    left: 0
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-active>a>.ks-group-amount {
    background-color: rgba(57, 81, 155, .1)
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-unread {
    background: rgba(247, 202, 24, .1)
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-unread>a>.ks-body>.ks-message {
    color: #333
}

.ks-messenger .ks-discussions>.ks-body .ks-items>.ks-item.ks-unread>a>.ks-group-amount {
    background-color: rgba(222, 187, 12, .2)
}

.ks-messenger .ks-messages,
.ks-messenger__messages {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    background: #fff
}

.ks-messenger .ks-messages>.ks-header,
.ks-messenger__messages>.ks-header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    height: 60px;
    border-bottom: 1px solid #dee0e1;
    padding: 9px 20px;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between
}

.ks-messenger .ks-messages>.ks-header>.ks-description>.ks-name,
.ks-messenger__messages>.ks-header>.ks-description>.ks-name {
    font-size: 14px;
    line-height: 14px;
    margin-bottom: 5px;
    font-weight: 500
}

.ks-messenger .ks-messages>.ks-header>.ks-description>.ks-amount,
.ks-messenger__messages>.ks-header>.ks-description>.ks-amount {
    color: #858585;
    font-size: 12px;
    line-height: 12px
}

.ks-messenger .ks-messages>.ks-body,
.ks-messenger__messages>.ks-body {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1
}

.ks-messenger .ks-messages>.ks-body .ks-items,
.ks-messenger__messages>.ks-body .ks-items {
    list-style: none;
    padding: 0;
    margin: 0;
    padding: 20px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-separator,
.ks-messenger__messages>.ks-body .ks-items>.ks-separator {
    color: #858585;
    font-size: 10px;
    text-align: center;
    text-transform: uppercase;
    margin-bottom: 15px;
    margin-top: 15px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item,
.ks-messenger__messages>.ks-body .ks-items>.ks-item {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    margin-bottom: 12px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item:last-child,
.ks-messenger__messages>.ks-body .ks-items>.ks-item:last-child {
    margin-bottom: 0
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body {
    font-size: 12px;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding: 12px 15px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    position: relative
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    margin-bottom: 2px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header>.ks-name,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header>.ks-name {
    font-weight: 500
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header>.ks-datetime,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-header>.ks-datetime {
    font-size: 10px;
    text-transform: uppercase;
    color: #858585
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-link,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-link {
    position: relative;
    margin-top: 10px;
    padding-left: 12px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-link:before,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-link:before {
    content: '';
    width: 4px;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(57, 81, 155, .2)
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files {
    list-style: none;
    padding: 0;
    margin: 0
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file {
    float: left;
    margin-top: 15px;
    margin-right: 15px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a {
    display: block;
    color: #333;
    vertical-align: top
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info,
.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb {
    float: left
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb {
    margin-right: 5px;
    text-align: center
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb>.ks-icon,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb>.ks-icon {
    font-size: 36px;
    line-height: 36px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb>img,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-thumb>img {
    width: 36px;
    height: 36px;
    -webkit-border-radius: 2px;
    border-radius: 2px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-name,
.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-size,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-name,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-size {
    display: block
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-name,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-name {
    font-size: 12px;
    margin-bottom: 2px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-size,
.ks-messenger__messages>.ks-body .ks-items>.ks-item>.ks-body>.ks-message>.ks-files>.ks-file a>.ks-info>.ks-size {
    font-size: 10px;
    text-transform: uppercase;
    color: #858585
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-self>.ks-avatar,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-self>.ks-avatar {
    -webkit-box-ordinal-group: 2;
    -webkit-order: 1;
    -ms-flex-order: 1;
    order: 1
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body {
    -webkit-box-ordinal-group: 3;
    -webkit-order: 2;
    -ms-flex-order: 2;
    order: 2;
    border: solid 1px #dee0e1;
    -webkit-border-top-left-radius: 0;
    border-top-left-radius: 0;
    margin-left: 14px;
    margin-right: 50px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body:before,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body:before {
    content: '';
    display: block;
    position: absolute;
    left: -10px;
    top: -1px;
    width: 0;
    height: 0;
    border-top: 10px solid #dee0e1;
    border-right: 0 solid transparent;
    border-bottom: 0 solid transparent;
    border-left: 10px solid transparent
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body:after,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-self>.ks-body:after {
    content: '';
    display: block;
    position: absolute;
    left: -8px;
    top: 0;
    width: 0;
    height: 0;
    border-top: 10px solid #fff;
    border-right: 0 solid transparent;
    border-bottom: 0 solid transparent;
    border-left: 10px solid transparent
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-from>.ks-avatar,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-from>.ks-avatar {
    -webkit-box-ordinal-group: 3;
    -webkit-order: 2;
    -ms-flex-order: 2;
    order: 2
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-from>.ks-body,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-from>.ks-body {
    -webkit-box-ordinal-group: 2;
    -webkit-order: 1;
    -ms-flex-order: 1;
    order: 1;
    background-color: #eff1f7;
    -webkit-border-top-right-radius: 0;
    border-top-right-radius: 0;
    margin-right: 14px;
    margin-left: 50px
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-from>.ks-body:before,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-from>.ks-body:before {
    content: '';
    display: block;
    position: absolute;
    right: -10px;
    top: 0;
    width: 0;
    height: 0;
    border-top: 0 solid transparent;
    border-right: 0 solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 10px solid #eff1f7
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-unread>.ks-body,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-unread>.ks-body {
    background: #fcf8e7
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-unread.ks-self>.ks-body:after,
.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-unread.ks-self>.ks-body:before,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-unread.ks-self>.ks-body:after,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-unread.ks-self>.ks-body:before {
    border-top: 10px solid #fcf8e7
}

.ks-messenger .ks-messages>.ks-body .ks-items>.ks-item.ks-unread.ks-from>.ks-body:before,
.ks-messenger__messages>.ks-body .ks-items>.ks-item.ks-unread.ks-from>.ks-body:before {
    border-left: 10px solid #fcf8e7
}

.ks-messenger .ks-messages>.ks-footer,
.ks-messenger__messages>.ks-footer {
    padding: 15px 20px;
    border-top: 1px solid #dee0e1;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex
}

.ks-messenger .ks-messages>.ks-footer>.form-control,
.ks-messenger__messages>.ks-footer>.form-control {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    height: 38px;
    overflow: hidden;
    resize: none;
    margin-right: 20px
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls,
.ks-messenger__messages>.ks-footer>.ks-controls {
    text-align: right;
    width: 207px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls .ks-attachment,
.ks-messenger .ks-messages>.ks-footer>.ks-controls .ks-smile,
.ks-messenger__messages>.ks-footer>.ks-controls .ks-attachment,
.ks-messenger__messages>.ks-footer>.ks-controls .ks-smile {
    font-size: 22px;
    color: #8997c3;
    line-height: 22px;
    margin-left: 25px
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown {
    display: inline-block
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smile,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smile {
    padding: 0
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys {
    width: 200px;
    height: 167px
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys .ks-smileys-wrapper,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys .ks-smileys-wrapper {
    padding: 10px
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table {
    width: 100%
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table td,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table td {
    vertical-align: middle;
    text-align: center;
    padding-bottom: 10px;
    cursor: pointer
}

.ks-messenger .ks-messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table tr:last-child td,
.ks-messenger__messages>.ks-footer>.ks-controls>.dropdown>.ks-smileys table tr:last-child td {
    padding-bottom: 0
}

.ks-messenger .ks-messages>.ks-files,
.ks-messenger__messages>.ks-files {
    list-style: none;
    padding: 0;
    margin: 0;
    padding: 20px;
    padding-top: 0;
    padding-bottom: 10px;
    margin-top: -10px
}

.ks-messenger .ks-messages>.ks-files>.ks-file,
.ks-messenger__messages>.ks-files>.ks-file {
    display: inline-block;
    cursor: pointer;
    margin-right: 10px;
    margin-top: 10px;
    position: relative
}

.ks-messenger .ks-messages>.ks-files>.ks-file:hover>.ks-thumb,
.ks-messenger__messages>.ks-files>.ks-file:hover>.ks-thumb {
    border: solid 1px #42a5f5
}

.ks-messenger .ks-messages>.ks-files>.ks-file>.ks-thumb,
.ks-messenger__messages>.ks-files>.ks-file>.ks-thumb {
    width: 90px;
    height: 90px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    background-color: #fff;
    border: solid 1px #dee0e1;
    margin-bottom: 5px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    text-align: center;
    font-size: 45px;
    color: #25628f
}

.ks-messenger .ks-messages>.ks-files>.ks-file>.ks-thumb::before,
.ks-messenger__messages>.ks-files>.ks-file>.ks-thumb::before {
    width: 100%
}

.ks-messenger .ks-messages>.ks-files>.ks-file>img.ks-thumb,
.ks-messenger__messages>.ks-files>.ks-file>img.ks-thumb {
    border: none
}

.ks-messenger .ks-messages>.ks-files>.ks-file>.ks-name,
.ks-messenger__messages>.ks-files>.ks-file>.ks-name {
    display: block;
    font-size: 12px;
    font-weight: 400;
    color: #333
}

.ks-messenger .ks-messages>.ks-files>.ks-file>.ks-size,
.ks-messenger__messages>.ks-files>.ks-file>.ks-size {
    position: relative;
    top: -2px;
    font-size: 10px;
    color: #858585
}

.ks-messenger .ks-info,
.ks-messenger__info {
    width: 240px;
    background: #fff;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    border-left: 1px solid #dee0e1
}

.ks-messenger .ks-info>.ks-header,
.ks-messenger__info>.ks-header {
    border-bottom: 1px solid #dee0e1;
    line-height: 15px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    height: 60px;
    padding: 20px
}

.ks-messenger .ks-info>.ks-body,
.ks-messenger__info>.ks-body {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding: 20px
}

.ks-messenger .ks-info>.ks-body>.ks-item+.ks-item,
.ks-messenger__info>.ks-body>.ks-item+.ks-item {
    margin-top: 10px
}

.ks-messenger .ks-info>.ks-body>.ks-item.ks-user,
.ks-messenger__info>.ks-body>.ks-item.ks-user {
    margin-bottom: 20px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex
}

.ks-messenger .ks-info>.ks-body>.ks-item.ks-user>.ks-avatar,
.ks-messenger__info>.ks-body>.ks-item.ks-user>.ks-avatar {
    margin-right: 12px
}

.ks-messenger .ks-info>.ks-body>.ks-item.ks-user>.ks-name,
.ks-messenger__info>.ks-body>.ks-item.ks-user>.ks-name {
    line-height: 31px;
    color: #333
}

.ks-messenger .ks-info>.ks-body>.ks-item>.ks-name,
.ks-messenger__info>.ks-body>.ks-item>.ks-name {
    color: #858585;
    margin-bottom: 3px
}

.ks-messenger .ks-info>.ks-body>.ks-list>.ks-header,
.ks-messenger__info>.ks-body>.ks-list>.ks-header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    color: #858585;
    margin-bottom: 15px
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item,
.ks-messenger__info>.ks-body>.ks-list .ks-item {
    margin-bottom: 15px
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item.ks-user,
.ks-messenger__info>.ks-body>.ks-list .ks-item.ks-user {
    margin-bottom: 20px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    -js-display: flex;
    display: flex
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item.ks-user>.ks-avatar,
.ks-messenger__info>.ks-body>.ks-list .ks-item.ks-user>.ks-avatar {
    margin-right: 12px
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item.ks-user>.ks-name,
.ks-messenger__info>.ks-body>.ks-list .ks-item.ks-user>.ks-name {
    line-height: 31px;
    color: #333
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item>.ks-owner,
.ks-messenger__info>.ks-body>.ks-list .ks-item>.ks-owner {
    position: relative;
    top: 1px
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item>.ks-owner>.ks-name,
.ks-messenger__info>.ks-body>.ks-list .ks-item>.ks-owner>.ks-name {
    display: block;
    line-height: 13px
}

.ks-messenger .ks-info>.ks-body>.ks-list .ks-item>.ks-owner>.ks-label-sm,
.ks-messenger__info>.ks-body>.ks-list .ks-item>.ks-owner>.ks-label-sm {
    padding: 2px;
    font-size: 9px
}

.ks-messenger .ks-info>.ks-footer,
.ks-messenger__info>.ks-footer {
    padding: 20px;
    border-top: 1px solid #dee0e1
}

.ks-messenger .ks-info>.ks-footer>.ks-item+.ks-item,
.ks-messenger__info>.ks-footer>.ks-item+.ks-item {
    margin-top: 10px
}

.ks-messenger .ks-info>.ks-footer>.ks-item>.ks-name,
.ks-messenger__info>.ks-footer>.ks-item>.ks-name {
    color: #858585;
    margin-bottom: 3px
}

.ks-messenger .ks-info>.ks-footer>.btn-block,
.ks-messenger__info>.ks-footer>.btn-block {
    margin-top: 15px
}

@media screen and (max-width:1200px) {
    .btn.ks-messenger-info-block-toggle {
        position: static
    }
    .ks-messenger .ks-info,
    .ks-messenger__info {
        position: fixed;
        top: 120px;
        bottom: 0;
        right: -241px;
        z-index: 4;
        height: -webkit-calc(100% - 120px);
        height: calc(100% - 120px)
    }
    .ks-messenger .ks-info.ks-open,
    .ks-messenger__info.ks-open {
        right: 0;
        -webkit-transition: right .2s ease;
        transition: right .2s ease
    }
}

@media screen and (max-width:800px) {
    .ks-messenger .ks-discussions {
        width: 100%
    }
    .ks-messenger .ks-messages,
    .ks-messenger__messages {
        position: fixed;
        top: 120px;
        bottom: 0;
        z-index: 2;
        height: -webkit-calc(100% - 120px);
        height: calc(100% - 120px);
        width: 100%;
        right: -1000px
    }
    .ks-messenger .ks-messages.ks-open,
    .ks-messenger__messages.ks-open {
        right: 0;
        -webkit-transition: right .2s ease;
        transition: right .2s ease
    }
}

@media screen and (max-width:560px) {
    .ks-messenger .ks-messages>.ks-footer,
    .ks-messenger__messages>.ks-footer {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column
    }
    .ks-messenger .ks-messages>.ks-footer textarea,
    .ks-messenger__messages>.ks-footer textarea {
        margin-bottom: 20px
    }
    .ks-messenger__ks-messages-footer {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column
    }
    .ks-messenger__ks-messages-footer textarea {
        margin-bottom: 20px
    }
}
button#dropdownMenuButton
{
	border:1px solid;
	color:#17a2b8;
	background:#17a2b8;
	
}
.dropdown-menu.dropdown-menu-right.ks-simple
{
	width:140px;
}
.ui-autocomplete { z-index:2147483647 !important; }

input#search
{
	display:none;
}

    </style>
</head>
<body>
<?php
require_once('templates/header.php');
//error_reporting(1);
//print_r($_SESSION);
?>
<div class="container">
<div class="ks-page-content">
    <div class="ks-page-content-body">
        <div class="ks-messenger">
            <div class="ks-discussions">
			
			   <div class="ks-controls">
                        <div class="dropdown">
                            <button class="btn btn-primary-outline ks-light ks-no-text ks-no-arrow" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="la la-ellipsis-h ks-icon" style="color:white;">Create Chat Room</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right ks-simple" aria-labelledby="dropdownMenuButton">
                                <!--<a class="dropdown-item" href="#">
                                    <span class="la la-user-plus ks-icon"></span>
                                    <span class="ks-text" data-toggle="modal" data-target="#addmember">Add members</span>
                                </a>-->
                                <a class="dropdown-item" href="#">
                                    <span class="la la-eye-slash ks-icon"></span>
                                    <span class="ks-text" data-toggle="modal" data-target="#addchatroom">Add Chat Room</span>
                                </a>
                                <!--<a class="dropdown-item" href="#">
                                    <span class="la la-bell-slash-o ks-icon"></span>
                                    <span class="ks-text">Leave Room</span>
									<input type="hidden" value="" id="leave_room">
                                </a>-->
                                
                            </div>
                        </div>
                    </div>
					<br>
					<br>
                <!--<div class="ks-search">
                    <div class="input-icon icon-right icon icon-lg icon-color-primary">
                        <input id="input-group-icon-text search_chatroom" type="text" class="form-control" placeholder="Search">
						<div class="result"></div>
                        <span class="icon-addon">
                <span class="la la-search"></span>
                        </span>
                    </div>
                </div>-->
								
				
                <div class="ks-body ks-scrollable jspScrollable" data-auto-height="" style="height: 554px; overflow-y: auto; padding: 0px; width: 339px;" tabindex="0">

                    <div class="jspContainer" id="chatroomnamedetail" style="width: 339px; height: 550px;">
                        <div class="jspPane" style="padding: 0px; top: 0px; width: 329px;">
                            <ul class="ks-items">
							<?php
			   $member_id=$_SESSION['id'];
				$my=mysqli_query($con,"select * from chat_member left join chatroom on chatroom.chatroomid=chat_member.chatroomid where chat_member.userid='$member_id' order by chatroom.date_created desc");
					while($myrow=mysqli_fetch_array($my)){
						$nq=mysqli_query($con,"select * from chat_member where chatroomid='".$myrow['chatroomid']."'");
						?>
				
                 
				
						<li class="ks-item ks-active user" style="width: 86%;float: left;">
						  <a href="#" chatroom="<?php echo $myrow['chat_name']; ?>" chatid="<?php echo $myrow['chatroomid'];?>" id="room_name">
                         <span class="ks-group-amount"><?php
					$num=mysqli_query($con,"select * from chat_member where chatroomid='".$myrow['chatroomid']."'");
					echo mysqli_num_rows($num);?></span>
						 <div class="ks-body">
						  <div class="ks-name">
						  <?php echo $myrow['chat_name']; ?>
						  
						  <span class="ks-datetime">just now</span>
						    </div>
							  <div class="ks-message">
							  <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="18" height="18" class="rounded-circle">
							  <?php
	$rm=mysqli_query($con,"select * from chat_member left join `users` on users.id=chat_member.userid where chatroomid='".$myrow['chatroomid']."' limit 2");
				$nam ='';
					while($rmrow=mysqli_fetch_array($rm)){
			   
				$creq=mysqli_query($con,"select * from chatroom where chatroomid='$chatid'");
						$crerow=mysqli_fetch_array($creq);
								
							if ($crerow['userid']==$rmrow['userid']){
						}
	
	
	                   // $name= $rmrow['name'].",";
						$nam= $nam.$rmrow['name'].',';
						//echo rtrim($name,',');
						//echo $name;
						
					            }
								//echo $nam;
								echo substr($nam, 0, -1);
                            echo "(...)";								
								?>
								
                                            </div>
                                        </div>
								
								</a>
								</li>
								
								
									<?php
								    
									$memb=mysqli_query($con,"select * from chatroom where userid='$member_id' and chatroomid='".$myrow['chatroomid']."'");
									if (mysqli_num_rows($memb)>0){
										?>
					<span style="background:#eff1f7;">
					<button type="button" class="btn btn-danger btn-sm delete2" style="margin-top: 64px;"  id="delete_room" value="<?php echo $myrow['chatroomid'];?>">Delete</button>
					</span>
										<?php
									}
									else{
										?>
										<!--<button type="button" class="btn btn-warning btn-sm leave2" value="<?php //echo $myrow['chatroomid']; ?>">Leave</button>-->
										<?php
									}
								?>
								
								
							
					<?php }?>
                               
                            </ul>
                        </div>
                        <div class="jspVerticalBar">
                            <div class="jspCap jspCapTop"></div>
                            <div class="jspTrack">
                                <div class="jspDrag" style="height: 261px;">
                                    <div class="jspDragTop"></div>
                                    <div class="jspDragBottom"></div>
                                </div>
                            </div>
                            <div class="jspCap jspCapBottom"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ks-messages ks-messenger__messages">
                <div class="ks-header">
                    <div class="ks-description">
					<div id="get_chatroomname"></div>
                        <!--<div class="ks-name">Chat name</div>
                        <div class="ks-amount">2 members</div>-->
                    </div>
					
					
					<!--<div class="ks-controls">
				  <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
    </ul>
  </div>
</div>-->


  <!-- Modal -->
  <div class="modal fade" id="addmember" role="dialog">
    <div class="modal-dialog" style="margin-top: 323px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div id="memberadded"></div>
          <h4 class="modal-title">Add New Member</h4>
        </div>
        <div class="modal-body">
         <input type="hidden"  id="roomid" value="">
		 <input type="hidden" id="roomname" value="">
		 
		  <input type="hidden" id="userid" value="">
		 
			 <input id="users"  placeholder="Search user...">
			 
        </div>
        <div class="modal-footer">
		 <button type="submit" id="add_member" class="btn btn-info"  style="font-size:15px;">Add Member</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
         
      </div>
      
    </div>
  </div>
  
  
  
  
   <!-- Modal -->
  <div class="modal fade" id="addchatroom" role="dialog">
    <div class="modal-dialog" style="margin-top: 323px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Chat Room</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <input type="text" id="chat_name" class="form-control" placeholder="Enter Chat Room Name">
            </div>
            <button type="submit" id ="createchatroom" class="btn btn-info">Create</button>
          </form>
		  <div id="results"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>	
					  <div class="ks-controls" id="ks-controls_again" style="display:none;"> 
                        <div class="dropdown">
                            <button class="btn btn-primary-outline ks-light ks-no-text ks-no-arrow" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="la la-ellipsis-h ks-icon" style="color:white;">Members</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right ks-simple" aria-labelledby="dropdownMenuButton">
                               <a class="dropdown-item" href="#">
                                    <span class="la la-user-plus ks-icon"></span>
                                    <span class="ks-text" data-toggle="modal" data-target="#addmember">Add members</span>
                                </a>
                                <!--<a class="dropdown-item" href="#">
                                    <span class="la la-eye-slash ks-icon"></span>
                                    <span class="ks-text" data-toggle="modal" data-target="#addchatroom">Add Chat Room</span>
                                </a>-->
                               <a class="dropdown-item" href="#">
                                    <span class="la la-bell-slash-o ks-icon"></span>
                                    <span class="ks-text" id="leave_room_chat">Leave Room</span>
									<input type="hidden" value="" id="leave_room">
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
<div class="ks-body ks-scrollable jspScrollable" data-auto-height="" style="height: 100%;overflow-y: auto;padding: 0px;width: 100%;" tabindex="0">                     <div class="jspContainer" style="width: 701px; height: 481px;">
                        <div class="jspPane" id="profile" style="padding: 0px; top: 0px; width: 691px;">
						  <div id="chat_area"></div>
                            <!--<ul class="ks-items">
                                <li class="ks-item ks-self">
                                    <span class="ks-avatar ks-offline">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="36" height="36" class="rounded-circle">
                                    </span>
                                    <div class="ks-body">
                                        <div class="ks-header">
                                            <span class="ks-name">Brian Diaz</span>
                                            <span class="ks-datetime">6:46 PM</span>
                                        </div>
                                        <div class="ks-message">The weird future of movie theater food</div>
                                    </div>
                                </li>
                                <li class="ks-item ks-from ks-unread">
                                    <span class="ks-avatar ks-online">
                                        <img src="http://bootdey.com/img/Content/avatar/avatar5.png" width="36" height="36" class="rounded-circle">
                                    </span>
                                    <div class="ks-body">
                                        <div class="ks-header">
                                            <span class="ks-name">Brian Diaz</span>
                                            <span class="ks-datetime">1 minute ago</span>
                                        </div>
                                        <div class="ks-message">
                                            The weird future of movie theater food

                                     
                                        </div>
                                    </div>
                                </li>
								</ul>-->
                        </div>
                        <div class="jspVerticalBar">
                            <div class="jspCap jspCapTop"></div>
                            <div class="jspTrack">
                                <div class="jspDrag">
                                    <div class="jspDragTop"></div>
                                    <div class="jspDragBottom"></div>
                                </div>
                            </div>
                            <div class="jspCap jspCapBottom"></div>
                        </div>
                    </div>
                </div>
                <div class="ks-footer">
                    <textarea class="form-control" placeholder="Type something..." id="chat_msg"></textarea>
                    <div class="ks-controls">
                        <button class="btn btn-primary" id="send_msg" style="background:#17a2b8;">Send</button>
                        <a href="#" class="la la-paperclip ks-attachment"></a>
                        <div class="dropdown dropup">
                            <button class="btn btn-link ks-smile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="la la-smile-o"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right ks-scrollable ks-smileys" aria-labelledby="dropdownMenuButton" style="overflow: hidden; padding: 0px; width: 200px;">

                                <div class="jspContainer" style="width: 198px; height: 165px;">
                                    <div class="jspPane" style="padding: 0px; top: 0px; left: 0px; width: 100px;">
                                        <div class="ks-smileys-wrapper">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar4.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar4.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar5.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar6.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar7.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar4.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar5.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar4.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar5.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar1.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar2.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar3.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar4.png" width="20" height="20">
                                                        </td>
                                                        <td>
                                                            <img src="http://bootdey.com/img/Content/avatar/avatar5.png" width="20" height="20">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ks-info ks-messenger__info" style="display:none;">
			
            <div id="userprofile"></div>
            </div>
        </div>
    </div>
</div>
</div>


</body>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="popper.min.js"></script>

<!--<script>
$(document).ready(function(){
    $(".ks-item").click(function(){
		 var u=$(this).attr('id');
	alert(u);
		
	});
	
	$("#profile").click(function(){
		//alert("hello");
		// var u=$(this).attr('id');
	//alert(u);
		
		$('.ks-messenger__info').toggle();
		
		 /*$.ajax({

              

               type: "POST",

               url: "userchatprofile.php",


               data: {

              user_id: id

               },
                success: function(html) {

                

                   $("#userprofile").html(html).show();

               }

           });*/
		
		
    });
});
</script>-->

<script type="text/javascript">
$(function() {
$(".user #room_name").click(function() {
	//alert("room");
var chatid = $(this).attr('chatid');
var chatroom=$(this).attr('chatroom');
 
$("#ks-controls_again").css("display","block");
$.ajax({
type: "POST",
url: "chat_room.php",
data: {chatid:chatid,chatroom:chatroom},
cache: true,
success: function(data){
	$("#show").html(data);
	 var result = $('<div />').append(data).find('.xyz').html();
	 var chatroomname = $('<div />').append(data).find('.chatroomname').html();
	 document.getElementById("send_msg").value = result;
	 document.getElementById("roomid").value = result;
	 document.getElementById("roomname").value = chatroomname;
	 document.getElementById("leave_room").value = chatid;
	 //document.getElementById("chat_roomname").value = chatroomname;
	  //document.getElementById("deleteroom").value = result;
	  //document.getElementById("leaveroom").value = result;
	// alert(result);
	
	$.ajax({
			url: 'chat_roomname.php',
			type: 'POST',
			async: false,
			data:{
				chatroomname: chatroomname,
				chatid:chatid
				
			},
			success: function(response){
				$('#get_chatroomname').html(response);
				
				//$("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
			}
		});
	
	 $.ajax({
			url: 'chat_fetch.php',
			type: 'POST',
			async: false,
			data:{
				result: result
				
			},
			success: function(response){
				$('#chat_area').html(response);
				$("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
			}
		});
}  
});
return false;
});
});
</script>
	<script>
	$(document).ready(function(){
		 
		   $(document).on('click', '#send_msg', function(){
			  
		 id=$('#send_msg').val();
		 msg = $('#chat_msg').val();
		 
		 //alert(id);
		 //alert(msg);
		 
		 	$.ajax({
					type: "POST",
					url: "send_message.php",
					data: {
						msg: msg,
						id: id,
					},
					success: function(ss){
						
						
					//$("#chat_area").html(ss);
						display_chat();
					}
				});
		  });
		  $(document).keypress(function(e){
			if (e.which == 13){
			$("#send_msg").click();
			$("#chat_msg").val('');
			}
		});
		function display_chat()
		{
		id=$('#send_msg').val();
		 msg = $('#chat_msg').val();
		 
		 $.ajax({
			url: 'fetch_chat.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				msg: msg,
			},
			success: function(response){
				$('#chat_area').html(response);
				$("#chat_area").scrollTop($("#chat_area")[0].scrollHeight);
			}
		});

		}
		 
		 });
</script>
 <script>
		   $(document).on('click', '#createchatroom', function(){
		   //alert("checked");
		chatname=$('#chat_name').val();
			$.ajax({
				url:"addchatroom.php",
				method:"POST",
				data:{
					chatname: chatname
				},
				success:function(data){
				$('#results').html(data);
				window.location.href='view_friends.php';
				}
			});
			
		
	});
	</script>
 <script>
 $(document).on('click', '#add_member', function(){
	 
   var userid = $("#userid").val();	
   var chatroomid = $("#roomid").val();
  // alert(chatroomid);
  // var chatroomid = $(".chatroomname option:selected").val();
   
		$.ajax({
				url:"addnewmember.php",
				method: "POST",
				data:{
					chatroomid: chatroomid,
					userid: userid
				},
				success:function(data){
			//	$('#memberadded').html(data);
				  $('#memberadded').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#memberadded').fadeOut("Slow");  
                          }, 2000); 
				window.location.href='view_friends.php';
				}
			});
		
	});
	</script>
	
<script>
	$(document).on('click', '#delete_room', function(){
		var nrid=$(this).val();
		//alert(nrid);
		
			$.ajax({
				url:"deleteroom.php",
				method:"POST",
				data:{
					id: nrid,
					del: 1,
				},
				success:function(ss){
					window.location.href='view_friends.php';
				}
			});
	});
	
</script>

<script>
	$(document).on('click', '#leave_room_chat', function(){
		//alert("leave");
		var nrid=$("#leave_room").val();
		//alert(nrid);
		
		$.ajax({
				url:"leaveroom.php",
				method:"POST",
				data:{
					id: nrid,
					leave: 1,
				},
				success:function(ss){
					window.location.href='view_friends.php';
				}
			});
		
	});
	
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  /*$(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
	  
    });
  });*/
 $(document).ready(function() {
   var selectedValue = '';
   $( '#users' ).autocomplete({
       source: 'chat_user.php',
       select: function(e, ui) {
         selectedValue = ui.item.value;
		 selectedValueid = ui.item.id;
		 document.getElementById("userid").value = selectedValueid;
		 
        // alert(selectedValue);
		 //alert(selectedValueid);
		 
		/* $.ajax({

              

               type: "POST",

               url: "autocomplete_result.php",


               data: {

              search: selectedValue

               },
                success: function(html) {

                

                   $("#productContainer").html(html).show();

               }

           });*/
		 
		 
       }
   });
 });
  </script>
<!--<script type="text/javascript">
$(document).ready(function(){
    $('.ks-search input[type="text"]').on("keyup input", function(){
		//alert("hiii");
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("chatroom-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(data){
      $(this).parents(".ks-search").find('input[type="text"]').val($(this).text());
	   var chatroomname = $('.ks-search').append(data).find('.chatroomnamedata').html();
	   //alert(chatroomname);
        $(this).parent(".result").empty();
		
		$.ajax({
				url:"chatroomsearching.php",
				method:"POST",
				data:{
					chatroomname: chatroomname
					
				},
				success:function(ss){
					//window.location.href='view_friends.php';
					$("#chatroomnamedetail").html(ss);
				}
			});
		
		
		
    });
});
</script>-->

<script type="text/javascript">
	$(document).ready(function(){
    $('.jspContainer').jScrollPane();
});
</script>
<style>
  .ks-search input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
  .result p {
    border: 1px solid #CCCCCC !important;
    margin-top: 26px !important;
    color: black !important;
}
	</style>
</html>