<?php
namespace TodChan\Alipay;

/**
 * @author: xin
 * Date: 2017/3/28
 * Time: 11:57
 */
class Pay
{

    private static $aop;

    public static function makeAop($appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox = false) {
        if (!self::$aop) {
            self::$aop = new AopClient;
            // 根据是否沙盒模式决定网关地址
            $gatewayUrl = $sandBox ? 'https://openapi.alipaydev.com/gateway.do' : 'https://openapi.alipay.com/gateway.do';
            self::$aop->gatewayUrl = $gatewayUrl;
            self::$aop->appId = $appId;
            self::$aop->rsaPrivateKey = $rsaPrivateKey;
            self::$aop->format = 'json';
            self::$aop->postCharset = 'UTF-8';
            self::$aop->signType = 'RSA2';
            self::$aop->alipayrsaPublicKey = $alipayRsaPublicKey;
            self::$aop->debugInfo = true;
        }

        return self::$aop;
    }

    /**
     * 创建App支付
     * @param AlipayTradeAppPayRequest $request            App支付请求对象
     * @param string                   $appId              支付宝应用AppId
     * @param string                   $rsaPrivateKey      私钥字符
     * @param string                   $alipayRsaPublicKey 支付宝公钥字符
     * @param bool|false               $sandBox            沙盒开启
     * @return string
     */
    public static function createAppPay($request, $appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox = false) {
        $aop = self::makeAop($appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox);
        $response = $aop->sdkExecute($request);

        return htmlspecialchars($response);
    }

    /**
     * @param AlipayTradeWapPayRequest $request            Wap支付请求对象
     * @param string                   $appId              支付宝应用AppId
     * @param string                   $rsaPrivateKey      私钥字符
     * @param string                   $alipayRsaPublicKey 支付宝公钥字符
     * @param bool|false               $sandBox            沙盒开启
     * @return string|提交表单HTML文本
     * @throws Exception
     */
    public static function createWapPay($request, $appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox = false) {
        $aop = self::makeAop($appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox);

        return $aop->pageExecute($request);
    }

    /**
     * 生成预支付信息
     * @param AlipayTradePrecreateRequest $request            预支付请求对象
     * @param string                      $appId              支付宝应用AppId
     * @param string                      $rsaPrivateKey      私钥字符
     * @param string                      $alipayRsaPublicKey 支付宝公钥字符
     * @param bool|false                  $sandBox            沙盒开启
     * @return bool|mixed|\SimpleXMLElement
     * @throws Exception
     */
    public static function createPrePay($request, $appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox = false) {
        $aop = self::makeAop($appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox);

        return $aop->execute($request);
    }

    /**
     * 查询订单
     * @param AlipayTradeQueryRequest $request            查询请求对象
     * @param string                  $appId              支付宝应用AppId
     * @param string                  $rsaPrivateKey      私钥字符
     * @param string                  $alipayRsaPublicKey 支付宝公钥字符
     * @param bool|false              $sandBox            沙盒开启
     * @return bool|mixed|\SimpleXMLElement
     * @throws Exception
     */
    public static function query($request, $appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox = false) {
        $aop = self::makeAop($appId, $rsaPrivateKey, $alipayRsaPublicKey, $sandBox);

        return $aop->execute($request);
    }

}