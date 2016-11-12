# Sangoma SBC REST API Examples


1. setting.inc.php 
 * API_KEY:  SBC API KEY created via pre-provisioning or SBC GUI 
 * SERVER: SBC IP address

2. Execute php examples
 * eg: php application_core_list.php

3. REST Definition
 * safepy_def.json


## Upgrade Procedure

1.  php update_package_upload.php <absolute path of upgrade package>
2.  php update_package_list.php  
3.  php application_service_stop.php
4.  php update_package_install.php <upgrade package name>
5.  php sngms_fwupdate.php
6.  php system_restart.php
7.  Wait for system to come back up via ping test
8.  php application_service_stop.php
9.  php application_configuration_apply.php
10. php application_service_start.php
	
## Backup

Set setting.inc.php for SBC that will be backed up

1. php application_archive_backup.php 
2. php application_archive_list.php 
3. php application_archive_download.php <backup file obtaion from _list.php>
 * File will be written in /tmp directory

## Restore

Set setting.inc.php for SBC that will receive restore

1. php application_archive_upload_post.php <absolute path of backup download file in /tmp directory>
2. php application_archive_list.php
 * Confirm restore is uploaded correctly
3. php application_archive_restore.php  <restore file obtained from _list.php>
 * Confirm result 
4. php system_reboot.php 
 * System must be rebooted
4. Wait for system to come back up via ping test
5. php application_archive_list.php

