<?php

/**
 * 調理カテゴリを作るクラス
 * BaseModelクラスを継承。
 */
class Category extends BaseModel
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // 親クラスのコンストラクタの呼び出し
        parent::__construct();
    }

    /**
     * レコードを全件取得する(期限日の古いものから並び替える)
     * 
     * @return array
     */
    public function categorySelectAll()
    {
        // SQL文を作成する
        $sql = 'SELECT * from category';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文を実行する
        $stmt->execute();

        // 取得するレコードを連想配列として返却する
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
