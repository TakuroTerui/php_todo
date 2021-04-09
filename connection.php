<?php
require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

// 新規作成処理
function createTodoData($todoText)
{
    $dbh = connectPdo();
    // $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    // $dbh->query($sql);
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)'; //編集
    $stmt = $dbh->prepare($sql); //追記
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR); //追記
    $stmt->execute(); //追記
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    return $dbh->query($sql)->fetchAll();
}

function updateTodoData($post)
{
    $dbh = connectPdo();
    // $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    // $dbh->query($sql);
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id'; //編集
    $stmt = $dbh->prepare($sql); //編集
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR); //編集
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT); //編集
    $stmt->execute(); //編集
}

function getTodoTextById($id)
{
    $dbh = connectPdo();
    // $sql = 'SELECT * FROM todos WHERE id = ' . $id . ' AND deleted_at IS NULL';
    // $data = $dbh->query($sql)->fetch();
    $sql = 'SELECT * FROM todos WHERE id = :id AND deleted_at IS NULL';
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();
    return $data['content'];
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    $now = date('Y-m-d H:i:s');
    // $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = ' . $id;
    // $dbh->query($sql);
    $sql = 'UPDATE todos SET deleted_at = :nowtime WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':nowtime', $now, PDO::PARAM_STR);
    $stmt->bindvalue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();   
}