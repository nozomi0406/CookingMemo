<?php

/**
 * バリデーションクラスです。
 */
class ValidationUtil
{
    /**
     * 調理名の妥当性をチェックします。
     *
     * @param string $cookingName 調理名
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidCookingName($cookingName, &$msg)
    {
        $msg = '';

        // 未入力の時
        if (empty($cookingName)) {
            $msg = "調理名を入力してください。";
            return false;
        }

        // 50文字を超えた時
        if (strlen($cookingName) > 50) {
            $msg = "恐れ入りますが、調理名は50文字以内でご入力ください。";
            return false;
        }

        return true;
    }

    /**
     * 調理時間の妥当性をチェックします。
     *
     * @param string $cookingTime 調理時間
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidCookingTime($cookingTime, &$msg)
    {
        $msg = '';

        // 未入力の時
        if (empty($cookingTime)) {
            $msg = "調理時間を入力してください。";
            return false;
        }

        if (!is_numeric($cookingTime)) {
            $msg = "調理時間は半角数字で入力してください。";
            return false;
        }

        return true;
    }

    /**
     * 調理カテゴリの妥当性をチェックします。
     *
     * @param string $category 調理カテゴリ
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidCategory($category, &$msg): bool
    {
        $msg = '';
        if (empty($category)) {
            $msg = "調理カテゴリを選択してください。";
            return false;
        }
        return true;
    }

    /**
     * 材料・調味料の妥当性をチェックします。
     *
     * @param string $material 材料・調味料
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidMaterial($material, &$msg)
    {
        $msg = '';

        // 未入力の時
        if (empty($material)) {
            $msg = "材料・調味料を入力してください。";
            return false;
        }

        return true;
    }

    /**
     * 調理方法の妥当性をチェックします。
     *
     * @param string $cookingMethod 調理方法
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidCookingMethod($cookingMethod, &$msg)
    {
        $msg = '';

        // 未入力の時
        if (empty($cookingMethod)) {
            $msg = "調理方法を入力してください。";
            return false;
        }

        return true;
    }

    /**
     * ポイント事項の妥当性をチェックします。
     *
     * @param  $memo ポイント事項
     * @param string $msg エラーメッセージが代入されます
     * @return boolean
     */
    public static function isValidMemo($memo, &$msg): bool
    {
        $msg = '';
        
        if (strlen($memo) > 1000) {
            $msg = "恐れ入りますが、ポイント事項は1,000文字以内で入力してください。";
            return false;
        }
        return true;
    }
}
