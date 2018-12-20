<?php
/*
 * PHPTALのphp式で使うと便利なヘルパー関数です
 */

if ( ! function_exists('test'))
{
    /**
     * $result を評価し、true なら $true_value を、 false なら $false_value を返します。
     */
    function test($result, $true_value, $false_value)
    {
        if ( $result ) {
            return $true_value;
        }
        return $false_value;
    }
}


if ( ! function_exists('format_date'))
{
    /**
     * $date を指定したフォーマットの文字列にして返します。
     */
    function format_date($format, $date)
    {
        if ( $date ) {
            return date($format, strtotime($date));
        }
        return null;
    }
}

if ( ! function_exists('format_number'))
{
    /**
     * $price を指定した通貨に応じてフォーマットします。
     */
    function format_number($number, $numDdecimals=0, $decimalSepalator='.', $housandsSepalator='', $default='0')
    {
        if ( $number === null ) return $default;
        return number_format($number, $numDdecimals, $decimalSepalator, $housandsSepalator);
    }
}

if ( ! function_exists('format_price'))
{
    /**
     * $price を指定した通貨に応じてフォーマットします。
     */
    function format_price($price, $currency, $housandsSepalator=',')
    {
        if ( $currency === 'JPY' ) {
            return format_number($price, 0, '.', $housandsSepalator);
        } else if ( $currency === 'USD' ) {
            return format_number($price, 2, '.', $housandsSepalator);
        }
        return format_number($price, '.', $housandsSepalator);
    }
}


if ( ! function_exists('test_and'))
{
    /**
     * 渡された引数を and で評価し、その結果を返します。
     */
    function test_and()
    {
        $args = func_get_args();

        $result = true;
        foreach ($args as $v) {
            $result = $result && $v;
        }
        return $result;
    }
}


if ( ! function_exists('test_or'))
{
    /**
     * 渡された引数を or で評価し、その結果を返します。
     */
    function test_or()
    {
        $args = func_get_args();

        $result = false;
        foreach ($args as $v) {
            $result = $result || $v;
        }
        return $result;
    }
}