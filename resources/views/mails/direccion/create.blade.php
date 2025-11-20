<x-mail::message>
#Titulo del correo
<x-mail::panel>
Parrafo del correo
</x-mail::panel>
<x-mail::button :url="{{route('direccion.show', $direccion)}}" color="primary">
Ver
</x-mail::button>
</x-mail::message>