<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Invite</title>
</head>
<body>

    <p>Beste {{$guestTitle}} {{$guestName}},</p>

    <p>Nu het tiende lustrum van de GSV steeds dichterbij komt, verzamelen we de gegevens van oudleden.
        U bent uitgenodigd door {{$hostName}} om uw gegevens bij te werken via onderstaande link.</p>
    <p>Het bijwerken duurt ongeveer twee minuten.</p>

    <p>Link: <a href="{{$url}}">{{$url}}</a>.</p>

    @if($message)
        <p>Persoonlijke boodschap:</p>
        <p>{!! nl2br(e($personalMessage)) !!}</p>
    @endif
</body>
</html>