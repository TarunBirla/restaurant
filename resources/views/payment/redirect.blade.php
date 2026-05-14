<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to TransactWorld...</title>
</head>
<body onload="document.forms[0].submit()">
    <p>Please wait, redirecting to TransactWorld...</p>

    <form method="POST" action="{{ env('TRANSACTWORLD_GATEWAY_URL') }}">
        @foreach($data as $key => $value)
            @if(is_array($value))
                @foreach($value as $v)
                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
    </form>
</body>
</html>
