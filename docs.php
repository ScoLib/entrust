<?php

require __DIR__.'/vendor/autoload.php';

use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir = __DIR__.'/src');

$versions = GitVersionCollection::create($dir)
    ->addFromTags('v2.0.*')
    ->add('2.0', '2.0 branch')
    ->add('master', 'master branch');

$options = [
    'versions'             => $versions,
    'title'                => 'Entrust API',
    'build_dir'            => __DIR__.'/build/docs/%version%',
    'cache_dir'            => __DIR__.'/build/cache/docs/%version%',
    'remote_repository'    => new GitHubRemoteRepository('scolib/entrust', dirname($dir)),
    'default_opened_level' => 2,
];

return new Sami($iterator, $options);
