document.addEventListener("DOMContentLoaded",function(){

    var doctor=document.getElementById("doctor");
    var fee=document.getElementById("docFees");
    var spec=document.getElementById("spec");

    if(doctor){

        doctor.addEventListener("change",function(){

            var selected=this.options[this.selectedIndex];

            fee.value=selected.getAttribute("data-value");

        });

    }

    if(spec){

        spec.addEventListener("change",function(){

            var selectedSpec=this.value;

            Array.from(doctor.options).forEach(function(option){

                if(
                    option.value==="" ||
                    option.getAttribute("data-spec")==selectedSpec
                ){

                    option.hidden=false;

                }else{

                    option.hidden=true;

                }

            });

        });

    }

});

function confirmDelete(message){

    return confirm(message);

}
