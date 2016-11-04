<?php
function native_curl($new_name, $new_email)
{
    // Alternative JSON version
    // $url = 'http://twitter.com/statuses/update.json';
    // Set up and execute the curl process
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, 'http://10.10.2.132/SAFe/sng_rest/file/test/1');
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
    'name' => $new_name,
    'email' => $new_email
    ));

    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);

    $result = json_decode($buffer);

    if(isset($result->status) && $result->status == 'success')
    {
        echo 'User has been updated.';
    }
    else
    {
        echo 'Something has gone wrong';
    }
}

var_dump($_POST);
var_dump($_FILES);
?>
<html>
<body>

<form action="/test/rest_sample/rest_file_update.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
