<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * Class BookSearch
 *
 * @package app\models
 */
class BookSearch extends Book
{
    public $dateFrom;
    public $dateTo;

    public function rules()
    {
        return [
            [['name'], 'safe'],
            [['dateFrom', 'dateTo'], 'match', 'pattern' => '/^\d{1,2}\/\d{1,2}\/\d{4}$/'],
            [['dateFrom', 'dateTo'], 'default', 'value' => null],
            ['author_id', 'filter', 'filter' => function($value) {
                return $value > 0 ? $value : null;
            }],
        ];
    }

    public function search(array $params = [])
    {
        $query = Book::find();

        if (!($this->load($params) && $this->validate())) {
            return new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
        }

        $dateFrom = $this->dateFrom ? \DateTime::createFromFormat('d/m/Y', $this->dateFrom)->format('Y-m-d') : null;
        $dateTo = $this->dateTo ? \DateTime::createFromFormat('d/m/Y', $this->dateTo)->format('Y-m-d') : null;

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['author_id' => $this->author_id]);
        $query->andFilterWhere(['>=', 'date', $dateFrom]);
        $query->andFilterWhere(['<=', 'date', $dateTo]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
