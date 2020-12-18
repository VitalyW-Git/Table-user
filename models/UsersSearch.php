<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

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
//            [['id', 'created_at', 'updated_at'], 'integer'],
//            [['name', 'surname', 'password', 'phone', 'email'], 'safe'],
            [['id'], 'integer'],
            [['name', 'surname', 'phone', 'email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // реализация обхода сценариев () в родительском классе
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

        // добавьте здесь условия, которые всегда должны применяться
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $this->load($params);
        if (!$this->load( $params ) && $this->validate()) {
            // раскомментируйте следующую строку, если вы не хотите возвращать какие-либо записи при сбое проверки
            // $query->where('0=1');
            return $dataProvider;
        }

        // условия фильтрации сетки
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);
        $query->andFilterWhere( ['id' => $this->id] );
        $query->andFilterWhere( ['like', 'name', $this->name] )
            ->andFilterWhere( ['like', 'surname', $this->surname] )
//            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere( ['like', 'phone', $this->phone] )
            ->andFilterWhere( ['like', 'email', $this->email] );

        return $dataProvider;
    }
}
