# Project2 设计文档

### 19302010022 张稷平

## 项目仓库地址

https://github.com/jiping-zhang/SOFT130002_pj2.git

## 网站地址

http://jiping-zhang.xyz:63373/

## 基本项完成情况：

全部完成

## Bonus完成情况：

1.密码加盐——已完成

2.前端框架——未完成

3.部署服务器——已完成

#### 1.密码加盐

在数据库中保存的密码实际上是密码和用户名连接的字符串的sha256加密形式

#### 3.部署服务器

白嫖阿里云学生服务器，腾讯云.xyz域名1元1年，，，

为了避免麻烦的备案，开了一个不常用端口。。。

## 其它一些功能：

#### 1.验证邮件

使用PHPMailer类，随机生成验证码，发往注册者的邮箱，注册者需要填写正确的验证码才能注册成功。

#### 2.修改密码

当用户忘记了密码，可以使用找回密码功能把密码改掉，在此过程中，用户也要到邮箱查收验证码

#### 3.滑块验证

用户在注册的时候需要完成滑块验证，防止了恶意注册、多次注册

#### 4.图片压缩

使用了ImgCompress类，把过大图片（大于1MB）压缩到1MB以内



