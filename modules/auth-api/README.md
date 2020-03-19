# 介绍

Hyperf 是基于 `Swoole 4.4+` 实现的高性能、高灵活性的 PHP 持久化框架


## 简单搭建登录注册身份验证
- 接口使用JWT身份验证
- 注册增加事件、事件监听器 注册成功发送邮件  邮件用异步队列延迟发送
- 所有接口请求及相应结果记录日志  日志用队列异步写入

## 安装说明
项目内已经准备好了各种版本的 Dockerfile ，或直接基于已经构建好的 hyperf\hyperf 镜像来运行。
如果不想采用 Docker 来作为运行的环境基础时，需要确保您的运行环境达到了以下的要求：
- PHP >= 7.2
- Swoole PHP 扩展 >= 4.4，并关闭了 Short Name
- OpenSSL PHP 扩展
- JSON PHP 扩展
- PDO PHP 扩展 （如需要使用到 MySQL 客户端）
- Redis PHP 扩展 （如需要使用到 Redis 客户端）
- Protobuf PHP 扩展 （如需要使用到 gRPC 服务端或客户端）

```
# 确保环境下安装composer的情况下,进入到项目目录下执行如下命令
cd hyperf-api-demo

# 执行composer
composer update

# 迁移数据，创建demo_db,在.env文件里配置自己的数据库、redis等信息

php bin/hyperf.php migrate

# 启动 Hyperf
php bin/hyperf.php start

```

## 如果需要使用Nginx 则需要配置 Http 反向代理
```
 # 至少需要一个 Hyperf 节点，多个配置多行
 upstream hyperf {
     # Hyperf HTTP Server 的 IP 及 端口
     server 127.0.0.1:9501;
     server 127.0.0.1:9502;
 }
 server {
     # 监听端口
     listen 80; 
     # 绑定的域名，填写您的域名
     server_name proxy.hyperf.io;
 
     location / {
         # 将客户端的 Host 和 IP 信息一并转发到对应节点  
         proxy_set_header Host $http_host;
         proxy_set_header X-Real-IP $remote_addr;
         proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
 
         # 转发Cookie，设置 SameSite
         proxy_cookie_path / "/; secure; HttpOnly; SameSite=strict";
 
         # 执行代理访问真实服务器
         proxy_pass http://hyperf;
     }
 }
```
## 接口使用说明
URL地址根据自己的机器配置

## 1. 授权
### 1.1 功能描述
获取token
### 1.2 请求说明
> 请求方式：POST<br>
请求URL ：[http://192.168.33.10:9501/api-auth/login](#)

### 1.3 请求参数
字段       |字段类型       |字段说明
------------|-----------|-----------
app_id       |string        |APP ID
app_secret       |string        |密钥
### 1.4 返回结果
```json  
{
    "code": 200,
    "message": "请求成功",
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxNTgyODkxODY2LCJuYmYiOjE1ODI4OTE4NjYsImV4cCI6MTU4Mjg5MTg2NiwiZGF0YSI6eyJhcHBfaWQiOiJmZW5nenl6IiwiYXBwX3NlY3JldCI6IjEyMzQ1NiJ9fQ.1QVFco9GgQjsiFoweFd-OLG-NfTJsUJynItEWY2Pt_s"
    }
}
``` 

## 1. 注册
### 1.1 功能描述
注册用户
### 1.2 请求说明
> 请求方式：POST<br> 
>设置--header 'Authorization: Bearer token值
    --header 'X-Real-IP: 127.0.0.1' 
请求URL ：[http://192.168.33.10:9501/api/user-register](#)

### 1.3 请求参数
字段       |字段类型       |字段说明
------------|-----------|-----------
username       |string        |用户名
password       |string        |密码
password_confirmation       |string        |确认密码
nickname       |string        |昵称
gender       |string        |性别
email       |string        |Email
birthday       |string        |出生年月
mobile       |string        |手机号
### 1.4 返回结果
```json  
{
    "code": 200,
    "message": "请求成功",
    "data": {
        "uid": "91991443974942721"
    }
}
``` 

## 1. 登录
### 1.1 功能描述
用户登录
### 1.2 请求说明
> 请求方式：POST<br>
请求URL ：[http://192.168.33.10:9501/api/user-login](#)

### 1.3 请求参数
字段       |字段类型       |字段说明
------------|-----------|-----------
username       |string        |用户名
password       |string        |密码
### 1.4 返回结果
```json  
{
    "code": 200,
    "message": "请求成功",
    "data": {
        "uid": "91847868079415297"
    }
}
``` 



