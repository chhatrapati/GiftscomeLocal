<!--Contact List end-->
<div id="drupalchat-wrapper">
    <div id="drupalchat" style="">
        <div class="item-list" id="chatbox_chatlist">
            <ul id="mainpanel">
                <li id="chatpanel" class="first last">
                    <div class="subpanel" style="display: block;">
                        <div class="subpanel_title">Chat<span class="options"></span>

                            <span class="min localhost-icon-minus-1" id="minmaxchatlist"><i class="fa fa-minus-circle minusicon text-20" aria-hidden="true"></i></span>
                            <span>&nbsp;&nbsp;</span>
                            <span class="min localhost-icon-minus-1" id="mute-sound"><i class="icon icon-volume-2 text-20" aria-hidden="true"></i></span>
                        </div>
                        <div id="showhidechatlist">
                            <div class="chat_options" style="background-color: #eceff1;" >
                                <div class="drupalchat-self-profile">
                                    <div class="drupalchat-self-profile-div">
                                        <div class="drupalchat-self-profile-img + localhost-avatar-sprite-28 <?php echo strtoupper($ses_username[0]); ?>_3">
                                            <img src="users-images/<?php echo $ses_picname; ?>"/>
                                        </div>
                                    </div>
                                    <div class="drupalchat-self-profile-namdiv">
                                        <a class="drupalchat-profile-un drupalchat_cng"><?php echo $sesUsername; ?></a>
                                    </div>

                                </div>

                            </div>
                            <div class="drupalchat_search_main chatboxinput" style="background:#f9f9f9">
                                <div class="drupalchat_search" style="height:30px;">
                                    <input class="drupalchat_searchinput live-search-box" placeholder="Type here to search" value="" size="24" type="text">
                                    <input class="searchbutton" value="" style="height:30px;border:none;margin:0px; padding-right:13px; vertical-align: middle;" type="submit"></div>
                            </div>
                            <div class="contact-list chatboxcontent">
                                <ul class="live-search-list">
                                    <?php
                                    /*$query = "select id,username,picname,message_date from userdata as u
                                    INNER JOIN
                                    (
                                    select message_id,to_id,from_id,message_date from messages where to_id = '".$_SESSION['id']."' or from_id = '".$_SESSION['id']."' GROUP BY to_id,from_id ORDER BY message_date desc
                                    ) m
                                    ON u.id = m.to_id
                                    where u.id != '".$_SESSION['id']."'
                                    ORDER BY message_date desc";*/
                                    //$query = "SELECT * FROM `".$config['db']['pre'].$MySQLi_user_table_name."` where $MySQLi_userid_field != '$sesId' order by last_active_timestamp DESC"; 
									$query = "SELECT * FROM `".$config['db']['pre'].$MySQLi_user_table_name."` wHERE $MySQLi_userid_field IN(SELECT myfriends FROM `myfriends` WHERE myid='$sesId') order by last_active_timestamp DESC";
                                    $result = $con->query($query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row[$MySQLi_userid_field];
                                        $username = $row[$MySQLi_username_field];
                                        $picname = $row[$MySQLi_photo_field];
                                        $picname = ($picname == "")? "avatar_default.png" : $picname;
										$user_type = $row['user_type'];
										if($user_type=='normal') { $star='';$cls='info'; $user_type ='Normal'; } else if($user_type=='vip') {$star='<span class="vip-star fa fa-star checked"></span>';$cls='success';$user_type ='Vip'; }
										$user_points = $row['user_points'];
										$user_medal = $row['user_medal'];
										$user_level = $user_obj-> get_level_point($id);
										$level =$user_level['user_level'];
                                        $res = mysqli_query($con, "SELECT * FROM `".$config['db']['pre'].$MySQLi_user_table_name."` WHERE $MySQLi_userid_field='$id' AND TIMESTAMPDIFF(MINUTE, $MySQLi_last_active_field, NOW()) > 1;");
                                        if($res === FALSE) {
                                            die(mysqli_error($con)); // TODO: better error handling
                                        }
                                        $num = mysqli_num_rows($res);
                                        if($num == "0")
                                            $onofst = "Online";
                                        else
                                            $onofst = "Offline";

                                        ?>


                                        <li class="iflychat-olist-item iflychat-ol-ul-user-img iflychat-userlist-room-item chat_options">
                                            <div class="drupalchat-self-profile">
                                                <span title="<?php echo $onofst ?>" class="<?php echo $onofst ?> statuso" style="text-align: right"><span class="statusIN"><i class="fa fa-circle" aria-hidden="true"></i></span></span>
                                                <div class="drupalchat-self-profile-div">
                                                    <div class="drupalchat-self-profile-img + localhost-avatar-sprite-28 <?php echo strtoupper($username[0]); ?>_3">
                                                        <?php if(!empty($row['user_picture'])) {?>
                                                            <img src="users-images/<?php echo $picname; ?>"/>
                                                        <?php } ?>
                                                    </div>
                                                </div>
												<?php echo $star;?>
												<div class="drupalchat-self-profile-namdiv">
                                                    <a class="drupalchat-profile-un drupalchat_cng" href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $username ?>','<?php echo $picname; ?>','<?php echo $onofst ?>')"><?php echo $username ?> <span class="badge badge-pill badge-<?php echo $cls;?>"><?php echo $user_type;?></span> <span class="badge badge-pill badge-warning"><?php echo $level;?></span>  </a>
                                                </div>

                                            </div>

                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</div>
<!--Contact List end-->

<!--This div for modal light box chat box image-->
<table id="lightbox"  style="display: none;height: 100%">
    <tr>
        <td height="10px"><p><img src="app/plugins/images/close-icon-white.png" width="30px" style="cursor: pointer"/></p></td>
    </tr>
    <tr>
        <td valign="middle"><div id="content"><img src="#"/></div></td>
    </tr>
</table>
<!--This div for modal light box chat box image-->