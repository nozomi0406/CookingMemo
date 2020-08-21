<?php

/**
 * 調理品を作るクラス
 * BaseModelクラスを継承。
 */
class Cooking extends BaseModel
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
     * レシピをレシピ名検索で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getRecipeBySearchRecipe($search)
    {

        $search = "%$search%";

        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking.id,';
        $sql .= 'cooking.user_id,';
        $sql .= 'cooking.photo,';
        $sql .= 'cooking.cooking_name,';
        $sql .= 'users.family_name,';
        $sql .= 'users.first_name,';
        $sql .= 'cooking.cooking_time,';
        $sql .= 'cooking.registration_date ';
        $sql .= 'from cooking ';
        $sql .= 'inner join users on cooking.user_id=users.id ';
        $sql .= 'where cooking.is_deleted=0 '; // 論理削除されている作業項目は表示対象外
        $sql .= "and (";
        $sql .= "cooking.cooking_name like :cooking_name ";
        $sql .= "or cooking.material like :material";
        $sql .= ") ";
        $sql .= 'order by cooking.registration_date desc';   // 期限日の順番に並べる

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_name', $search, PDO::PARAM_STR);
        $stmt->bindValue(':material', $search, PDO::PARAM_STR);

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
        $sql .= 'cooking.id,';
        $sql .= 'cooking.user_id,';
        $sql .= 'cooking.photo,';
        $sql .= 'cooking.cooking_name,';
        $sql .= 'users.family_name,';
        $sql .= 'users.first_name,';
        $sql .= 'cooking.cooking_time,';
        $sql .= 'cooking.registration_date ';
        $sql .= 'from cooking ';
        $sql .= 'inner join users on cooking.user_id=users.id ';
        $sql .= 'inner join cooking_category on cooking.id=cooking_category.cooking_id ';
        $sql .= 'where cooking.is_deleted=0 '; // 論理削除されている作業項目は表示対象外
        $sql .= "and (";
        $sql .= "cooking_category.category_id=:category_id ";
        $sql .= ") ";
        $sql .= 'order by cooking.registration_date desc';   // 期限日の順番に並べる

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':category_id', $search, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * レシピをレシピ名検索で抽出して取得します。（削除済みの作業項目は含みません）
     *
     * @param mixed $search 検索キーワード
     * @return array 作業項目の配列
     */
    public function getRecipeBySearchTime($search)
    {

        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking.id,';
        $sql .= 'cooking.user_id,';
        $sql .= 'cooking.photo,';
        $sql .= 'cooking.cooking_name,';
        $sql .= 'users.family_name,';
        $sql .= 'users.first_name,';
        $sql .= 'cooking.cooking_time,';
        $sql .= 'cooking.registration_date ';
        $sql .= 'from cooking ';
        $sql .= 'inner join users on cooking.user_id=users.id ';
        $sql .= 'where cooking.is_deleted=0 '; // 論理削除されている作業項目は表示対象外
        $sql .= "and (";
        $sql .= "cooking.cooking_time<=:cooking_time ";
        $sql .= ") ";
        $sql .= 'order by cooking.registration_date desc';   // 期限日の順番に並べる

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_time', $search, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 料理を全件取得します。（削除済みの料理は含みません）
     *
     * @return array 料理の配列
     */
    public function getRecipeAll()
    {
        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking.id,';
        $sql .= 'cooking.user_id,';
        $sql .= 'cooking.photo,';
        $sql .= 'cooking.cooking_name,';
        $sql .= 'users.family_name,';
        $sql .= 'users.first_name,';
        $sql .= 'cooking.cooking_time,';
        $sql .= 'cooking.registration_date ';
        $sql .= 'from cooking ';
        $sql .= 'inner join users on cooking.user_id=users.id ';
        $sql .= 'where cooking.is_deleted=0 ';        // 論理削除されている作業項目は表示対象外
        $sql .= 'order by cooking.registration_date desc';   // 期限日の順番に並べる

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 指定した料理1件を取得します。
     *     
     * @param integer $id
     * @return array 作業項目の配列
     */
    public function getRecipePart($id)
    {
        $sql = '';
        $sql .= 'SELECT ';
        $sql .= 'cooking.id,';
        $sql .= 'cooking.user_id,';
        $sql .= 'cooking.photo,';
        $sql .= 'cooking.cooking_name,';
        $sql .= 'users.family_name,';
        $sql .= 'users.first_name,';
        $sql .= 'cooking.cooking_time,';
        $sql .= 'cooking.registration_date,';
        $sql .= 'cooking.material,';
        $sql .= 'cooking.cooking_method,';
        $sql .= 'cooking.memo ';
        $sql .= 'from cooking ';
        $sql .= 'inner join users on cooking.user_id=users.id ';
        $sql .= 'where cooking.id=:id ';
        $sql .= 'order by cooking.registration_date asc';   // 期限日の順番に並べる

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 新規レシピを追加する
     *
     * @param array $param
     * 
     * @param integer $userId
     * @param string $photo
     * @param string $cookingName
     * @param string $cookingTime     
     * @param string $material
     * @param string $cookingMethod
     * @param string $memo
     * @param string $registrationDate
     * @return void
     */
    public function recipeInsert(array $param)
    {

        $sql = 'INSERT into cooking (';
        $sql .= 'user_id,';
        $sql .= 'photo,';
        $sql .= 'cooking_name,';
        $sql .= 'cooking_time,';
        $sql .= 'material,';
        $sql .= 'cooking_method,';
        $sql .= 'memo,';
        $sql .= 'registration_date';
        $sql .= ') values (';
        $sql .= ':user_id,';
        $sql .= ':photo,';
        $sql .= ':cooking_name,';
        $sql .= ':cooking_time,';
        $sql .= ':material,';
        $sql .= ':cooking_method,';
        $sql .= ':memo,';
        $sql .= ':registration_date';
        $sql .= ')';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':user_id', $param['userId'], PDO::PARAM_INT);
        $stmt->bindValue(':photo', $param['photo'], PDO::PARAM_STR);
        $stmt->bindValue(':cooking_name', $param['cookingName'], PDO::PARAM_STR);
        $stmt->bindValue(':cooking_time', $param['cookingTime'], PDO::PARAM_INT);
        $stmt->bindValue(':material', $param['material'], PDO::PARAM_STR);
        $stmt->bindValue(':cooking_method', $param['cookingMethod'], PDO::PARAM_STR);
        $stmt->bindValue(':memo', $param['memo'], PDO::PARAM_STR);
        $stmt->bindValue(':registration_date', $param['registrationDate'], PDO::PARAM_STR);

        // SQLを実行する
        return $stmt->execute();
    }

    /**
     * 指定した料理1件を修正します。
     *     
     * @param array $param
     * @return boolean 作業項目の配列
     */
    public function recipeUpdate(array $param): bool
    {

        $sql = '';
        $sql .= 'UPDATE cooking set ';
        $sql .= isset($param['userId']) ? 'user_id=:user_id,' : '';
        $sql .= isset($param['photo']) ? 'photo=:photo,' : '';
        $sql .= isset($param['cookingName']) ? 'cooking_name=:cooking_name,' : '';
        $sql .= isset($param['registrationDate']) ? 'registration_date=:registration_date,' : '';
        $sql .= isset($param['cookingTime']) ? 'cooking_time=:cooking_time,' : '';
        $sql .= isset($param['material']) ? 'material=:material,' : '';
        $sql .= isset($param['cookingMethod']) ? 'cooking_method=:cooking_method,' : '';
        $sql .= isset($param['memo']) ? 'memo=:memo' : '';
        $sql .= ' where id=:id';

        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        if (isset($param['userId'])) {
            $stmt->bindValue(':user_id', $param['userId'], PDO::PARAM_INT);
        }

        if (isset($param['photo'])) {
            $stmt->bindValue(':photo', $param['photo'], PDO::PARAM_STR);
        }


        if (isset($param['cookingName'])) {
            $stmt->bindValue(':cooking_name', $param['cookingName'], PDO::PARAM_STR);
        }

        if (isset($param['cookingTime'])) {
            $stmt->bindValue(':cooking_time', $param['cookingTime'], PDO::PARAM_STR);
        }

        if (isset($param['material'])) {
            $stmt->bindValue(':material', $param['material'], PDO::PARAM_STR);
        }

        if (isset($param['cookingMethod'])) {
            $stmt->bindValue(':cooking_method', $param['cookingMethod'], PDO::PARAM_STR);
        }

        if (isset($param['memo'])) {
            $stmt->bindValue(':memo', $param['memo'], PDO::PARAM_STR);
        }

        if (isset($param['registrationDate'])) {
            $stmt->bindValue(':registration_date', $param['registrationDate'], PDO::PARAM_STR);
        }

        // idは必須
        $stmt->bindValue(':id', $param['id'], PDO::PARAM_INT);

        // SQLを実行する
        return $stmt->execute();
    }

    /**
     * 指定IDのレコードを削除する
     *
     * @param integer $id
     * @return void
     */
    public function recipeDalete($id)
    {
        $sql = 'UPDATE cooking set is_deleted=1 where id=:id';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // SQLを実行する
        return $stmt->execute();
    }

    /**
     * レシピ名で検索したレシピを取得する
     * 
     * @return array
     */
    public function recipeNameSearch($cookingName)
    {
        $cookingName = "%$cookingName%";

        // SQL文を作成する
        $sql = 'SELECT * from cooking ';
        $sql .= 'INNER JOIN users ON cooking.user_id=users.user_id ';
        $sql .= 'where cooking_name like :cooking_name ';
        $sql .= 'AND cooking.is_deleted = 0';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':cooking_name', $cookingName, PDO::PARAM_STR);

        // SQL文を実行する
        $stmt->execute();

        // 取得するレコードを連想配列として返却する
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
