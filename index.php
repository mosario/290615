<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\JSXAsset;
use frontend\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
    <a href="" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#Modal">Launch Demo Modal</a>
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Главная', 'url' => ['/site/index']],
                ['label' => 'О нас', 'url' => ['/site/about']],
                ['label' => 'Обратная связь', 'url' => ['/site/contact']],
                '<li><a data-toggle="modal" data-target="#registration" href="/application/frontend/web/index.php?r=user/signup">Sign In</a></li>',
                '<li><a data-toggle="modal" data-target="#registration" href="/application/frontend/web/index.php?r=user/login">Login in</a></li>'
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = [
                            'label' => 'Зарегистрироваться', 
                            'id' => 'modal',
                            'url' => '/application/frontend/web/index.php?r=user/signup',
                            'data-toggle'=>'modal',
                                'data-target'=>'#Modal',
                            'options' => [
                                'role' => 'button',
                                'data-toggle'=>'modal',
                                'data-target'=>'#Modal'
                                ]
                            ];
                $menuItems[] = [
                'label' => 'Войти', 
                'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        <div class="container">
        <div id="example" ></div>

        <div id="registration" class="modal fade"></div>
        <div id="LoginIn" class="modal fade"></div>
    
<script type="text/jsx">
Modal = React.createClass({
    getInitialState: function(){
        return {
            flip: false
        };
    },
    getDefaultProps: function(){
        return {
            login: '/application/frontend/web/index.php?r=user/login',
            Sign: '/application/frontend/web/index.php?r=user/signup',
        };
    },
    flipped: function(){
        this.setState({flip: !this.state.flip});
    },
    render: function(){
        return <div>
                <div id="Signup" className={"modal-dialog Signup" + (this.state.flip ? " effect__click" : " ")}>
                    <div className="modal-content"></div>
                    <div>
                        <button className="p-a btn" onClick={this.flipped} data-toggle="modal" data-target="#LoginIn" data-remote={this.props.login}>Я уже зерегистрирован!</button>
                    </div>
                </div>

                <div id="LoginIn" className={"modal-dialog LoginIn" + (this.state.flip ? " " : " effect__click")}>
                    <div className="modal-content"></div>
                            <button className="btn btn-default p-a" data-dismiss="modal">Close</button>
                             <button className="p-a btn" onClick={this.flipped} data-toggle="modal" data-target="#Signup" data-remote={this.props.Sign}>Я еще не зерегистрирован!</button>
                </div>
            </div>
    }
});
LoginIn = React.createClass({
    render: function(){
        console.log(this.state);
        return <div id="LoginIn" className={"modal fade LoginIn" + (this.props.flipped ? " effect__click" : " ")}>
            <div className="modal-dialog">
                <div className="modal-content">
                    <p className="p-a">Hello!</p> 
                </div>
                <button className="p-a btn" onClick={this.flipped}>Edit.state</button>
            </div>
            </div>
    }
});
React.render(<Modal />, document.getElementById('registration'));
</script>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
