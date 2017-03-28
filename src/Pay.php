<?php
namespace TodChan\Alipay;

/**
 * @author: xin
 * Date: 2017/3/28
 * Time: 11:57
 */
class Pay
{

    /**
     * 创建App支付
     * @param string                   $appId              支付宝应用AppId
     * @param string                   $rsaPrivateKey      私钥字符
     * @param string                   $alipayRsaPublicKey 支付宝公钥字符
     * @param AlipayTradeAppPayRequest $request            App支付请求对象
     * @param bool|false               $sandBox            沙盒开启
     * @return string
     */
    public static function createAppPay($appId, $rsaPrivateKey, $alipayRsaPublicKey, $request, $sandBox = false) {
        $aop = new AopClient;
        // 根据是否沙盒模式决定网关地址
        $gatewayUrl = $sandBox ? 'https://openapi.alipaydev.com/gateway.do' : 'https://openapi.alipay.com/gateway.do';
        $aop->gatewayUrl = $gatewayUrl;
        $aop->appId = $appId;
        $aop->rsaPrivateKey = $rsaPrivateKey;
        $aop->format = 'json';
        $aop->postCharset = 'UTF-8';
        $aop->signType = 'RSA2';
        $aop->alipayrsaPublicKey = $alipayRsaPublicKey;
        $aop->debugInfo = true;

        $response = $aop->sdkExecute($request);

        return htmlspecialchars($response);
    }

    /**
     * @param string                   $appId              支付宝应用AppId
     * @param string                   $rsaPrivateKey      私钥字符
     * @param string                   $alipayRsaPublicKey 支付宝公钥字符
     * @param AlipayTradeWapPayRequest $request            Wap支付请求对象
     * @param bool|false               $sandBox            沙盒开启
     * @return string|提交表单HTML文本
     * @throws Exception
     */
    public static function createWapPay($appId, $rsaPrivateKey, $alipayRsaPublicKey, $request, $sandBox = false) {
        $aop = new AopClient;
        // 根据是否沙盒模式决定网关地址
        $gatewayUrl = $sandBox ? 'https://openapi.alipaydev.com/gateway.do' : 'https://openapi.alipay.com/gateway.do';
        $aop->gatewayUrl = $gatewayUrl;
        $aop->appId = $appId;
        $aop->rsaPrivateKey = $rsaPrivateKey;
        $aop->format = 'json';
        $aop->postCharset = 'UTF-8';
        $aop->signType = 'RSA2';
        $aop->alipayrsaPublicKey = $alipayRsaPublicKey;
        $aop->debugInfo = true;

        return $aop->pageExecute($request);
    }

    /**
     * 生成预支付信息
     * @param string                      $appId              支付宝应用AppId
     * @param string                      $rsaPrivateKey      私钥字符
     * @param string                      $alipayRsaPublicKey 支付宝公钥字符
     * @param AlipayTradePrecreateRequest $request            预支付请求对象
     * @param bool|false                  $sandBox            沙盒开启
     * @return bool|mixed|\SimpleXMLElement
     * @throws Exception
     */
    public static function createPrePay($appId, $rsaPrivateKey, $alipayRsaPublicKey, $request, $sandBox = false) {
        $aop = new AopClient;
        // 根据是否沙盒模式决定网关地址
        $gatewayUrl = $sandBox ? 'https://openapi.alipaydev.com/gateway.do' : 'https://openapi.alipay.com/gateway.do';
        $aop->gatewayUrl = $gatewayUrl;
        $aop->appId = $appId;
        $aop->rsaPrivateKey = $rsaPrivateKey;
        $aop->format = 'json';
        $aop->postCharset = 'UTF-8';
        $aop->signType = 'RSA2';
        $aop->alipayrsaPublicKey = $alipayRsaPublicKey;
        $aop->debugInfo = true;

        return $aop->execute($request);
    }
}