<?php

/**
 * 調理品と調理カテゴリを繋げるクラス
 * BaseModelクラスを継承。
 */
class Cooking_Category extends BaseModel
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
     * 全件取得します。（削除済みの作業項目は含みません）
     * 
     * @param integer $id
     * @return array 作業項目の配列
     */
    public function getCategory($cookingId)
    {
        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking_category.category_id,';
        $sql .= 'category.category ';
        $sql .= 'from cooking_category ';
        $sql .= 'inner join category on cooking_category.category_id=category.id ';
        $sql .= 'where cooking_id = :cooking_id '; // 論理削除されている作業項目は表示対象外

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_id', $cookingId, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * レシピをカテゴリ検索で抽出して取得します。（削除済みの作業項目は含みません）
     * 
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getCategoryBySearchCategory($search)
    {
        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking_category.category_id,';
        $sql .= 'category.category ';
        $sql .= 'from cooking_category ';
        $sql .= 'inner join category on cooking_category.category_id=category.id ';
        $sql .= 'where category_id = :category_id '; // 論理削除されている作業項目は表示対象外
        $sql .= "and (";
        $sql .= "category.category_id like :category_id";
        $sql .= ")";

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':category_id', $search, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 新規レコードを追加する
     *
     * @param integer $cookingId
     * @param integer $categoryId
     * @return void
     */
    public function cookingCategoryInsert($cookingId, $categoryId)
    {
        $sql = 'INSERT into cooking_category(';
        $sql .= 'cooking_id,';
        $sql .= 'category_id';
        $sql .= ') values (';
        $sql .= ':cooking_id,';
        $sql .= ':category_id';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_id', $cookingId, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

        // SQLを実行する
        return $stmt->execute();
    }

    // /**
    //  * 料理カテゴリを修正する
    //  *
    //  * @param integer $cookingId
    //  * @param integer $categoryId
    //  * @return void
    //  */
    // public function cookingCategoryUpdate($cookingId, $categoryId)
    // {

    //     $sql = 'INSERT into cooking_category(';
    //     $sql .= 'cooking_id,';
    //     $sql .= 'category_id';
    //     $sql .= ') values (';
    //     $sql .= ':cooking_id,';
    //     $sql .= ':category_id';
    //     $sql .= ')';

    //     // SQL文を実行する準備
    //     $stmt = $this->dbh->prepare($sql);

    //     // SQL文の該当箇所に、変数の値を割り当て（バインド）する
    //     $stmt->bindValue(':cooking_id', $cookingId, PDO::PARAM_INT);
    //     $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

    //     // SQLを実行する
    //     return $stmt->execute();
    // }

    /**
     * レコードを削除する
     *
     * @param integer $cookingId
     * @return void
     */
    public function cookingCategoryDelete($cookingId)
    {
        $sql = 'DELETE from cooking_category where cooking_id=:cooking_id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_id', $cookingId, PDO::PARAM_INT);

        // SQLを実行する
        return $stmt->execute();
    }
}
