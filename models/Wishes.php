<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wishes".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property int $order
 * @property string $budget
 * @property string $user
 *
 * @property Budgets $budget0
 * @property UsersAuth $user0
 */
class Wishes extends RestModel
{

    const MODAL_HEADER_CONFIG = [
        'title' => '{title}', //В скобках поле из модели будет подставлено значение
        'titleForNew' => 'New wish',
        'closeButton' => true,
        'bg' => 'warning'
    ];
    const MODAL_CONTENT_CONFIG = [
        'type' => self::MODAL_CONTENT_TYPE_FORM,
        'formConfig' => []
    ];
    const MODAL_FOOTER_CONFIG = [
        'bg' => 'dark',
        'buttons' => [
            [
                'class' => 'btn-primary',
                'text' => 'Save',
                'action' => 'save'
            ]
        ]
    ];

    const GRID_FIELDS = [
        'title',
        'description',
        'price'
    ];

    const GRID_CONTENT_COMPONENTS = [
        'title' => 'WishlistTitleColumnComponent',
        'description' => 'DescriptionColumnComponent'
    ];

    const GRID_HEADER_COMPONENTS = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['order', 'budget', 'user'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['budget'], 'exist', 'skipOnError' => true, 'targetClass' => Budgets::class, 'targetAttribute' => ['budget' => 'id']],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => UsersAuth::class, 'targetAttribute' => ['user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'title'         => 'Title',
            'description'   => 'Description',
            'price'         => 'Price',
            'order'         => 'Order',
            'budget'        => 'Budget',
            'user'          => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget0()
    {
        return $this->hasOne(Budgets::class, ['id' => 'budget']);
    }

    public function getFormConfig(){
        return [
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'id',
                'title' => $this->getAttributeLabel('id')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'title',
                'title' => $this->getAttributeLabel('title')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'description',
                'title' => $this->getAttributeLabel('description')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'price',
                'title' => $this->getAttributeLabel('price')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'order',
                'title' => $this->getAttributeLabel('order')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'budget',
                'title' => $this->getAttributeLabel('budget')
            ],
            [
                'component' => self::FIELD_TEXT_FIELD,
                'key' => 'user',
                'title' => $this->getAttributeLabel('user')
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(UsersAuth::class, ['id' => 'user']);
    }
}
