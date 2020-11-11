<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$profile = new \Pixelbrackets\OpenSourceProfile\ProfileApp;
$title = $profile::getTitle();
$username = $profile->getUser()['username'];
$projects = $profile->getProjects();

$list = '';
foreach ($projects as $project) {
    $list .= '<li><a href="' . $project['repository-url'] . '">' . $project['repository-url'] . '</a> – ' . $project['description'] . '</li>';
}
$content = '<h1>' . $title . '</h1><h2>@' . $username . '</h2><ul>' . $list . '</ul>';

$template = (new \Pixelbrackets\Html5MiniTemplate\Html5MiniTemplate())
    ->setStylesheet('skeleton')
    ->setStylesheetMode(\Pixelbrackets\Html5MiniTemplate\Html5MiniTemplate::STYLE_INLINE)
    ->setTitle($title)
    ->setContent($content);
echo $template->getMarkup();
