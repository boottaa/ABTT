<?php
/**
 * Created by PhpStorm.
 * User: boott
 * Date: 05.01.2017
 * Time: 14:13
 */



Template::$tmp = 'off';
Template::$title = 'chatbot';
Template::addStyle('admin/bootstrap.min.css');
Template::addStyle('admin/font-awesome.min.css');
Template::addScript('admin/jquery.min.js');
Template::addScript('admin/bootstrap.min.js');
Template::addStyle('admin/sb-admin-2.css');
Template::addStyle('chatbot/chatbot.css');
Template::addScript('chatbot/ChatBot.js');

require_once Rout::on(__DIR__);