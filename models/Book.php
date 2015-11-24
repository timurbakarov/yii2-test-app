<?php

namespace app\models;

use Intervention\Image\ImageManagerStatic;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    CONST UPLOADS_PATH = 'uploads/';
    CONST THUMBS_FOLDER = 'thumbs/';

    const THUMB_WIDTH = 100;
    const THUMB_HEIGHT = 130;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, jpeg'],
            [['name', 'date'], 'required'],
            [['date_update', 'date_create'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'preview' => 'Превью',
            'date' => 'Дата выхода книги',
            'author_id' => 'Автор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => 'date_update',
                ],
                'value' => new Expression('NOW()')
            ],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->upload();

        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if(!$this->imageFile) {
            return;
        }

        $fileName = $this->imageFile->baseName . '.' . $this->imageFile->extension;

        $path = $this->previewPath($fileName);

        $this->imageFile->saveAs($path);

        $image = ImageManagerStatic::make($path)->fit(self::THUMB_WIDTH, self::THUMB_HEIGHT);
        $image->save($this->previewThumbsPath($fileName));

        $this->preview = $fileName;
    }

    /**
     * @return string
     */
    public function previewWebPath()
    {
        return Url::to(self::UPLOADS_PATH . $this->preview);
    }

    /**
     * @return string
     */
    public function previewThumbWebPath()
    {
        return Url::to(self::UPLOADS_PATH . self::THUMBS_FOLDER . $this->preview);
    }

    /**
     * @param $fileName
     * @return string
     */
    public function previewPath($fileName)
    {
        return Yii::getAlias('@webroot') . '/'. self::UPLOADS_PATH . $fileName;
    }

    /**
     * @param $fileName
     * @return string
     */
    public function previewThumbsPath($fileName)
    {
        return Yii::getAlias('@webroot') . '/'. self::UPLOADS_PATH . self::THUMBS_FOLDER . $fileName;
    }
}
