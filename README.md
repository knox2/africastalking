# AfricasTalking Laravel Package

## Installation


```
composer require knox/africastalking
```


## Config
Get the below details from africastalking

```
AFT_APIKEY=apikey
AFT_USERNAME=username
```

## Usage

### Sending SMS

#### Without sender ID

Params: 

```
use AFT;
AFT::sendMessage($phone_number, $message);
```

#### With sender ID

Params: 

```
use AFT;
AFT::sendMessage($phone_number, $message, 'Sender ID');
```
