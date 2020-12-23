<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsersSearch представляет собой модель поисковой формы `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['id'], 'integer'],
            [['name', 'surname', 'phone', 'email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search( $params )
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->load( $params ) && $this->validate()) {

            return $dataProvider;
        }

        // строгая фильтрация
        $query->andFilterWhere( ['id' => $this->id] );
        // частичное совпадение строки like
        $query->andFilterWhere( ['like', 'name', $this->name] )
            ->andFilterWhere( ['like', 'surname', $this->surname] )
            ->andFilterWhere( ['like', 'phone', $this->phone] )
            ->andFilterWhere( ['like', 'email', $this->email] );

        return $dataProvider;
    }
}
