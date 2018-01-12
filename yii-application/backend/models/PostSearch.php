<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'integer'],
            [['id'], 'integer'],
            [['title', 'description', 'date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 9,
             ],
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC,
                    //'title' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'category' => $this->category
        ]);

        var_dump($query);
        $query->orFilterWhere(['like', 'title', $this->title])
            ->orFilterWhere(['like', 'description', $this->title])
            ->orFilterWhere(['like', 'CPU', $this->title])
            ->orFilterWhere(['like', 'MotherBoard', $this->title])
            ->orFilterWhere(['like', 'ComputerCase', $this->title])
            ->orFilterWhere(['like', 'VideoCard', $this->title])
            ->orFilterWhere(['like', 'CoolingSystem', $this->title])
            ->orFilterWhere(['like', 'RAM', $this->title])
            ->orFilterWhere(['like', 'ROM', $this->title])
            ->orFilterWhere(['like', 'PowerSupply', $this->title])
            ->orFilterWhere(['like', 'AudioCard', $this->title]);

        return $dataProvider;
    }


    public function getSomeValuse($params, $count)
    {
        $query = Post::find();        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
                'page' => 0
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'category' => $this->category
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'description', $this->description])
              ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}
