<?php

//trong trường hợp 1 số function check url cần full url
function getSite()
{
    return "http://localhost:8080/1804HDTV/";
}

//kiểm tra link có tồn tại hay không
function URLExists($url)
{
    if (!$fp = curl_init($url)) {
        return false;
    }
    return true;
}

//dùng cho select sql, trả về array
function getSql($sql)
{
    include "sconnectadmin.php";
    $result = $cn->query($sql);
    if (!$result) {
        echo $cn->error;
        exit;
    }
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $result->close();
    $cn->close();
    if (isset($rows)) {
        return $rows;
    } else {
        return array();
    }
}

//dùng cho insert, trả về boolean
function insertSql($sql)
{
    include "sconnectadmin.php";
    $cn->query($sql);

    if ($cn->affected_rows <= 0) {
        echo $cn->error;
        $cn->close();
        return false;
    }
    $cn->close();
    return true;
}

//dùng cho update, trả về boolean
function updateSql($sql)
{
    include "sconnectadmin.php";
    $cn->query($sql);

    if ($cn->affected_rows <= 0) {
        echo $cn->error;
        $cn->close();
        return false;
    }
    $cn->close();
    return true;
}

//dùng cho delete, trả về boolean
function deleteSql($sql)
{
    include "sconnectadmin.php";
    $cn->query($sql);

    if ($cn->affected_rows <= 0) {
        echo $cn->error;
        $cn->close();
        return false;
    }
    $cn->close();
    return true;
}