<?php

namespace App\Caches;

use App\Builders\CategoryTreeList as CategoryTreeListBuilder;

class CategoryTreeList extends Cache
{

    protected $lifetime = 365 * 86400;

    public function getLifetime()
    {
        return $this->lifetime;
    }

    public function getKey($type = null)
    {
        return "category_tree_list:{$type}";
    }

    public function getContent($type = null)
    {
        $builder = new CategoryTreeListBuilder();

        $list = $builder->handle($type);

        return $list ?: [];
    }

}
