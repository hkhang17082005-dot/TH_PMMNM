<?php
require_once 'app/config/database.php';
require_once 'app/models/AccountModel.php';
require_once 'app/helpers/SessionHelper.php';
require_once 'vendor/autoload.php';

class OAuthController {
    private $githubProvider;
    private $facebookProvider;
    private $accountModel;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($db);

  $this->githubProvider = new \League\OAuth2\Client\Provider\Github([
    'clientId'     => 'Ov23lioR5rejSOuPUzk0',
    'clientSecret' => 'de8fe3495d465881621ed174c7ec367c05507cc3',
    'redirectUri'  => 'http://127.0.0.1:8888/DOHOANGDANH/oauth/githubCallback',
    'scopes'       => ['read:user'],
]);

       $this->facebookProvider = new \League\OAuth2\Client\Provider\Facebook([
    'clientId'        => '849154711581259',
    'clientSecret'    => 'fa1f0586f9b8324734dd78c6c52ed062',
    'redirectUri'     => 'http://127.0.0.1:8888/DOHOANGDANH/oauth/facebookCallback',
    'graphApiVersion' => 'v18.0',
    'scope'           => ['public_profile'],
]);
    }

    public function github() {
    SessionHelper::start();
    $authUrl = $this->githubProvider->getAuthorizationUrl([
        'scope' => ['read:user']
    ]);
    $_SESSION['oauth2state'] = $this->githubProvider->getState();
    header('Location: ' . $authUrl);
    exit;
}

    public function githubCallback() {
    SessionHelper::start();
    if (empty($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
        unset($_SESSION['oauth2state']);
        die('Invalid state');
    }
    $token = $this->githubProvider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
    
    // Gọi API GitHub trực tiếp
    $request = $this->githubProvider->getAuthenticatedRequest(
        'GET',
        'https://api.github.com/user',
        $token
    );
    $response = $this->githubProvider->getParsedResponse($request);
    
    $username = 'github_' . $response['id'];
    $fullname = $response['name'] ?? $response['login'] ?? 'GitHub User';
    $this->loginOrRegister($username, $fullname);
}

   public function facebook() {
    SessionHelper::start();
    $authUrl = $this->facebookProvider->getAuthorizationUrl([
        'scope' => ['public_profile']
    ]);
    $_SESSION['oauth2state'] = $this->facebookProvider->getState();
    header('Location: ' . $authUrl);
    exit;
}

    public function facebookCallback() {
        SessionHelper::start();
        if (empty($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
            unset($_SESSION['oauth2state']);
            die('Invalid state');
        }
        $token = $this->facebookProvider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        $user = $this->facebookProvider->getResourceOwner($token);
        $username = 'fb_' . $user->getId();
        $fullname = $user->getName();
        $this->loginOrRegister($username, $fullname);
    }

    private function loginOrRegister($username, $fullname) {
        $account = $this->accountModel->getAccountByUsername($username);
        if (!$account) {
            $this->accountModel->save($username, $fullname, uniqid(), 'user');
        }
        SessionHelper::start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        header('Location: /DOHOANGDANH/Product');
        exit;
    }
}
?>
