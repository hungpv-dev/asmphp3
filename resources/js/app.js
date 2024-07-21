import './bootstrap';
import swal from 'sweetalert';

Echo.channel('order')
    .listen('OrderNotify',function(e){
        console.log(e);
    })