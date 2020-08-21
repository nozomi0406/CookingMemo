<?php

/**
 * ユーザーを作るクラス
 * BaseModelクラスを継承。
 */
class Users extends BaseModel
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
     * 新規ユーザーを追加する
     *
     * @param string $user
     * @param string $familyName
     * @param string $firstName
     * @return void $password
     */
    public function addUser(string $user, string $familyName, string $firstName, string $password, &$msg)
    {

        // 同じユーザーIDのユーザーがいないか調べる
        if (!empty($this->selectUser($user))) {
            // 同じユーザーIDのユーザーが存在したらfalseを返却
            $msg = '既に同じユーザーIDが登録されています。';
            return false;
        }

        // パスワードをハッシュ化(暗号化)します。
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT into users (user, family_name, first_name, password)';
        $sql .= ' values ';
        $sql .= '(:user, :family_name, :first_name, :password)';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文の該当箇所に、変数の値を割り当て（バインド）する
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->bindValue(':family_name', $familyName, PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);

        // SQLを実行する
        $stmt->execute();

        // 処理が終了したらtrueを返却
        return true;
    }

    /**
     * 選択したユーザーの情報を取得する(期限日の古いものから並び替える)
     * 
     * @return array
     */

    public function selectUser($user)
    {
        // SQL文を作成する
        $sql = 'select * from users where user=:user';

        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);

        // SQL文のパラメータに値を割り当てます
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);

        // SQL文を実行する
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        // falseが返却されたときは、空の配列を返却ß
        if (empty($rec)) {
            return [];
        }
        return $rec;
    }

    // /**
    //  * ログインをする
    //  *
    //  * @param string $user
    //  * @param string $password
    //  * @return void
    //  */
    public function login($user, $password)
    {
        $return = $this->selectUser($user);

        // 入力されたEmialのユーザーを検索
        if (empty($return)) {
            return [];
        }

        // パスワードが一致するかどうか
        if (password_verify($password, $return['password'])) {
            // パスワードが一致ならユーザーの情報を連想配列で返す
            return $return;
        }
        return [];
    }

    ////////////////////////////////////////////////////////////////////////////////
    // バリデーション
    ////////////////////////////////////////////////////////////////////////////////

    /**
     * ユーザーIDの妥当性をチェックします。
     *
     * @param string $user ユーザーID
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */

    public static function isValidUser($user, &$msg = ""): bool
    {
        if (empty($user)) {
            $msg = "ユーザーIDを入力してください。";
            return false;
        }
        if (strlen($user) > 50) {
            $msg = "恐れ入りますが、ユーザーIDは50文字以内でご入力ください。";
            return false;
        }
        return true;
    }

    /**
     * 姓の妥当性をチェックします。
     *
     * @param string $familyName 姓
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidFamilyName($familyName, &$msg = ""): bool
    {
        if (empty($familyName)) {
            $msg = "姓を入力してください。";
            return false;
        }
        return true;
    }

    /**
     * 名の妥当性をチェックします。
     *
     * @param string $firstName 名
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidFirstName($firstName, &$msg = ""): bool
    {
        if (empty($firstName)) {
            $msg = "名を入力してください。";
            return false;
        }
        return true;
    }

    /**
     * パスワードの妥当性をチェックします。
     *
     * @param string $password パスワード
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidPassword($password, &$msg = ""): bool
    {
        if (empty($password)) {
            $msg = "パスワードを入力してください。";
            return false;
        }
        if (strlen($password) > 20) {
            $msg = "恐れ入りますが、パスワードは20文字以内で入力してください。";
            return false;
        }
        return true;
    }
}
