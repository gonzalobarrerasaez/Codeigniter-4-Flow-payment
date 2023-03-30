### Integración sistema de pago FLOW en Codeigniter 4

1. Clone este repo en /app/ThirdParty
2. Cree un archivo Flow.php dentro de /app/Libraries/ con el siguiente contenido

```php
<?php

namespace App\Libraries;

use \FlowApi;

class Flow extends FlowApi
{
    public function __construct()
    {
        parent::__construct();
    }
}
```

3- Genere la carga de clases y namespaces necesarios en el archivo /app/Config/Autoload.php

```php
     public $psr4 = [
        .....
        'Flow'              => APPPATH . 'Libraries/Flow.php',
    ];

     public $classmap = [
        'FlowApi'           => APPPATH . 'ThirdParty/flow/lib/FlowApi.class.php',
    ];
```

4. En el controlador que va a ejecutar la llamada instancie la clase y los metodos correspondientes
    
    1. Ejecutar un pago de un pedido
    ```php
        $params = array(
            'commerceOrder' =>  xxx,
            'subject'       => 'xxx',
            'currency'      => 'CLP',
            'amount'        =>  xxx,
            'email'         =>  xxx,
            'paymentMethod' => 9,
            'urlConfirmation' => base_url('payment/confirm'),
            'urlReturn'     => base_url('payment/return')
        );

        $service = 'payment/create';
        $method = 'POST';

        $flow = new Flow();
        $response = $flow->send($service, $params, $method);
        $destination = $response['url'] . '?token=' . $response['token'];
        return redirect()->to($destination); 
    ```
    2. Obtener la información de un pedido
```php
    $token = $this->request->getPost('token');
    $params = array(
        'token' => $token
    );
    $service = 'payment/getStatus';
    $method = 'GET';

    $flow = new Flow();
    $response = $flow->send($service, $params, $method)
```