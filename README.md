# PHPMailTools

基于PHPMailer构建邮件发送工具

```
MailTools.php  邮件工具类
config\mail.php 邮箱配置信息
```

## 开始 

通过composer安装phpmailer

```
composer require phpmailer/phpmailer
```

如果项目为ThinkPHP：

```
在extend文件夹下创建utils文件夹放入MailTools.php
导入mail.php到对应的config文件夹
```

理论上PSR的项目都可以正常使用，其他项目需要修改邮件配置信息载入方式即可

## 注意

```
部分邮件服务商需要SSL协议才可正常连接，请在PHP配置中开启openssl并且载入基础ssl证书就可以正常使用！
```



[访问我的个人博客](http://www.treesystem.cn)

![关注我的公众号](http://github.com/alextreeo/PublicImages/blob/master/public_account/5821634867.jpg?raw=true)