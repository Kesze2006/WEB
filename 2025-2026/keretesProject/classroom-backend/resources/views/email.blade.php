<h1>Kérlek erősítsd meg az emailed!</h1>
<p>
  Küldtünk egy linket a regisztrált email címedre.
  Ha nem kaptad meg, <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">újraküldés</button>
  </form>
</p>