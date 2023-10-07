# 学习 FastAdmin

## 项目：订单系统

### 项目说明

我实现了一个简单的订单系统，用来订电影票的。

用户：从前台查看电影信息、加入购物车、下订单、查看订单状态。

![](./screenshots/home.png)
![](./screenshots/home-cart.png)
![](./screenshots/home-order.png)

管理员：从后台录入电影信息、查看用户的订单、编辑订单状态。

![](./screenshots/admin-movie.png)
![](./screenshots/admin-order.png)

## 测试网址

https://learn-fastadmin-2023.hcloudcs.com/

### 后台管理员账号

- 地址：https://learn-fastadmin-2023.hcloudcs.com/fastadmin.php
- 账号：admin
- 密码：admin@admin.com

### 前台测试账号

- 账号：example
- 密码：example@example.com

## 本地部署

FastAdmin 从 Git 源代码部署有困难，比如官方文档没有介绍，只有从压缩包部署才有介绍。我自己在本地开发后，部署也是从压缩包部署的，因为源代码中缺少了部署文件，比如
vendor thinkphp 目录等。我也不清楚最佳部署实践是什么。

## 订单系统的数据库表结构

FastAdmin 从数据库中生成后台的 CRUD 表单，订单系统的数据库表结构如下：

- `fa_movie` 电影表
- `fa_order` 订单表
- `fa_order_item` 订单项表

```sql
CREATE TABLE `fa_movie`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `category_id`  int(10) unsigned DEFAULT '0' COMMENT '分类ID(单选)',
    `category_ids` varchar(100)  DEFAULT NULL COMMENT '分类ID(多选)',
    `tags`         varchar(255)  DEFAULT '' COMMENT '标签',
    `flag` set('hot','index','recommend') DEFAULT '' COMMENT '标志(多选):hot=热门,index=首页,recommend=推荐',
    `title`        varchar(100)  DEFAULT '' COMMENT '标题',
    `content`      text COMMENT '内容',
    `image`        varchar(100)  DEFAULT '' COMMENT '图片',
    `images`       varchar(1500) DEFAULT '' COMMENT '图片组',
    `json`         varchar(255)  DEFAULT NULL COMMENT '配置:key=名称,value=值',
    `price`        decimal(10, 2) unsigned DEFAULT '0.00' COMMENT '价格',
    `views`        int(10) unsigned DEFAULT '0' COMMENT '点击',
    `startdate`    date          DEFAULT NULL COMMENT '开始日期',
    `refreshtime`  bigint(20) DEFAULT NULL COMMENT '刷新时间',
    `createtime`   bigint(20) DEFAULT NULL COMMENT '创建时间',
    `updatetime`   bigint(20) DEFAULT NULL COMMENT '更新时间',
    `deletetime`   bigint(20) DEFAULT NULL COMMENT '删除时间',
    `weigh`        int(11) DEFAULT '0' COMMENT '权重',
    `switch`       tinyint(1) DEFAULT '0' COMMENT '开关',
    `status`       enum('normal','hidden') DEFAULT 'normal' COMMENT '状态',
    `state`        enum('0','1','2') DEFAULT '1' COMMENT '状态值:0=禁用,1=正常,2=推荐',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `fa_order`
(
    `id`         int(11) NOT NULL AUTO_INCREMENT,
    `user_id`    int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
    `status`     enum('0','1','2') DEFAULT '1' COMMENT '状态值:0=已取消,1=待处理,2=已完成',
    `createtime` bigint(20) DEFAULT NULL COMMENT '创建时间',
    `updatetime` bigint(20) DEFAULT NULL COMMENT '更新时间',
    `deletetime` bigint(20) DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `fa_order_item`
(
    `id`         int(11) NOT NULL AUTO_INCREMENT,
    `order_id`   int(11) NOT NULL COMMENT '订单 ID',
    `movie_id`   int(11) NOT NULL COMMENT '电影 ID',
    `count`      int(11) NOT NULL COMMENT '购买数量',
    `createtime` bigint(20) DEFAULT NULL COMMENT '创建时间',
    `updatetime` bigint(20) DEFAULT NULL COMMENT '更新时间',
    `deletetime` bigint(20) DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
```

## 订单系统的已知问题

### 后台订单列表没有显示产品信息

还应该显示订购者的姓名，而不是数字，这里关联的关系，我还不完全弄明白 FastAdmin 的表格是如何定制的。
