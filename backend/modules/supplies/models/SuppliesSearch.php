<?php

namespace backend\modules\supplies\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\supplies\models\Supplies;

/**
 * SuppliesSearch represents the model behind the search form about `backend\modules\supplies\models\Supplies`.
 */
class SuppliesSearch extends Supplies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'type_mat', 'type_blind', 'color', 'status'], 'integer'],
            [['images', 'type_width', 'price'], 'safe'],
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
        $query = Supplies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'type_mat' => $this->type_mat,
            'type_blind' => $this->type_blind,
            'color' => $this->color,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'type_width', $this->type_width])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}
