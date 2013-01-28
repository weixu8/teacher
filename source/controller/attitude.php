<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function attitude($type)
{
    if (!$GLOBALS['has_login'])
        return;

	$class = camel2under($type);
    $map = array('like' => 1, 'hate' => 0);

    $target = _req('target');
    $action = _req('action');
    $info = array($type => $target, 'user' => $GLOBALS['user'], '`like`' => $map[$action]);
    Attitude::create($info);

	$o = new $class($target);
	echo $o->{$action.'Count'}();
}
