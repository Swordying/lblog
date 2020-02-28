<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Laravel 教程-Web 开发实战入门

## 1、项目介绍
1. L01 Laravel 教程-Web 开发实战入门 ( Laravel 6.x ) 
2. 练习者：乔木

## 2、基本信息
1. PHP 版本 v7.2
2. Laravel 版本 v6.17.1
3. 项目种类：博客
4. 开发环境：Homestead
5. 用户认证使用的是 laravel/ui

## 3、项目基本功能
1. 用户功能
    1. 用户注册与登录
    2. 密码重设
    3. 修改信息
    4. 用户中心
2. 博客功能
    1. 发布博客
    2. 博客列表
    3. 删除博客
    4. 统计功能
3. 粉丝功能
    1. 关注与取关
    2. 粉丝列表
    3. 被关注者列表
4. 后台管理
    1. 管理用户
    2. 管理博客
    3. 查看粉丝

## 4、项目数据表
1. 基本数据表会在安装 Laravel-admin 后自动迁移
2. 关注表 followers 字段：id、user_id、follower_id、created_at、updated_at
3. 动态表 statuses 字段：id、content、user_id、created_at、updated_at

## 难点与关键点
1. 使用 Homestead 搭建开发环境
2. 后台管理系统 Laravel-admin 的安装与使用
3. 关联模型的使用
