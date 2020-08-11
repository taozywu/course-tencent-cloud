<?php

namespace App\Repos;

use App\Models\Help as HelpModel;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\ResultsetInterface;

class Help extends Repository
{

    /**
     * @param int $id
     * @return HelpModel|Model|bool
     */
    public function findById($id)
    {
        return HelpModel::findFirst($id);
    }

    /**
     * @param array $ids
     * @param array|string $columns
     * @return ResultsetInterface|Resultset|HelpModel[]
     */
    public function findByIds($ids, $columns = '*')
    {
        return HelpModel::query()
            ->columns($columns)
            ->inWhere('id', $ids)
            ->execute();
    }

    /**
     * @param array $where
     * @return ResultsetInterface|Resultset|HelpModel[]
     */
    public function findAll($where = [])
    {
        $query = HelpModel::query();

        $query->where('1 = 1');

        if (!empty($where['category_id'])) {
            $query->andWhere('category_id = :category_id:', ['category_id' => $where['category_id']]);
        }

        if (!empty($where['title'])) {
            $query->andWhere('title LIKE :title:', ['title' => "%{$where['title']}%"]);
        }

        if (isset($where['published'])) {
            $query->andWhere('published = :published:', ['published' => $where['published']]);
        }

        if (isset($where['deleted'])) {
            $query->andWhere('deleted = :deleted:', ['deleted' => $where['deleted']]);
        }

        $query->orderBy('category_id ASC,priority ASC');

        return $query->execute();
    }

}
