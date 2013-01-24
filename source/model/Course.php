<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Course extends BasicModel
{
    public static function create($info)
    {
        $info['created=NOW()'] = $info['touched'] = null;
        return parent::create($info);
    }

    public function star($star, User $user)
    {
        $info = compact('user', 'star');
        $info['course'] = $this;
        CourseStar::create($info);
        $cs = CourseStar::search()->filterBy('course', $this)->find();
        $css = array_map(function ($c) {return $c->star;}, $cs);
        $starCount = count($css);
        $average = array_sum($css) / $starCount;
        $arr = array('star' => $average, 'star_count' => $starCount, 'touched=NOW()' => null);
        $this->update($arr);
        return $this->star;
    }

    public function isStaredBy(User $user)
    {
        $conds = array('user=? AND course=?' => array($user->id, $this->id));
        $info = Sdb::fetchRow('*', CourseStar::table(), $conds);
        return $info ? true : false;
    }

    public function starBy(User $user)
    {
        $conds = array('user=? AND course=?' => array($user->id, $this->id));
        $info = Sdb::fetchRow('*', CourseStar::table(), $conds);
        return $info['star'];
    }
}
