CSE carrier api interaction library.

# Api documentation

<https://lk.cse.ru/files/uploads/extended_api_2017_02_07_1rv_EngVer.pdf>

[Integration (Russian)](https://lk.cse.ru/help/integration)

#  Install

    php composer.phar require gam6itko/cse-carrier
    
# Usage
   
    $cseWebService = new CseWebService('your_login', 'your_password', 'http://web.cse.ru/1c/ws/Web1C.1cws?wsdl');
   
    $parameters = (new Element())
       ->setKey('Parameters')
       ->setList([
           new Element('Reference', $referenceName, 'string')
       ]);
    
    /** @var Element $requestResult */
    $requestResult = $cseWebService->getReferenceData($parameters);