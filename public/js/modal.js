   // login modal
   const modalLogin = document.querySelector('#modalLogin');
   const modalType = document.querySelector('#modalType');
   const modalBuyer = document.querySelector('#modalBuyer');
   const modalSeller = document.querySelector('#modalSeller');
   const modalAgent = document.querySelector('#modalAgent');

   function modalLoginToggle(){
       modalType.classList.add('hidden');
       modalType.classList.remove('flex');
       modalLogin.classList.toggle('hidden');
       modalLogin.classList.toggle('flex');

   }
   function modalTypeToggle(){
       modalLogin.classList.add('hidden');
       modalLogin.classList.remove('flex');

       modalType.classList.toggle('hidden');
       modalType.classList.toggle('flex');

   }
   function modalBuyerToggle(){
       modalType.classList.add('hidden');
       modalType.classList.remove('flex');

       modalBuyer.classList.toggle('hidden');
       modalBuyer.classList.toggle('flex');

   }
   function modalSellerToggle(){
       modalType.classList.add('hidden');
       modalType.classList.remove('flex');

       modalSeller.classList.toggle('hidden');
       modalSeller.classList.toggle('flex');

   }
   function modalAgentToggle(){
       modalType.classList.add('hidden');
       modalType.classList.remove('flex');

       modalAgent.classList.toggle('hidden');
       modalAgent.classList.toggle('flex');

   }



   // upload file seller
   const previewImage = document.querySelector('#preview')
   function uploadFile(e)
   {
       previewImage.src = URL.createObjectURL(e.files[0]);

   }

   function previewImageProperty(e)
   {
    const x = e.closest('div').children[0]?.children[0].children[1];
    //    previewImage.src = URL.createObjectURL(e.files[0]);
     x.src = URL.createObjectURL(e.files[0]);

   }
   const previewImageAgent = document.querySelector('#previewAgent')
   function uploadFileAgent(e)
   {
       previewImageAgent.src = URL.createObjectURL(e.files[0]);

   }
//    dropdown profile
const profileDropdown = document.querySelector("#profileDropdown");
function dropdownProfile() {


    profileDropdown.classList.toggle('hidden')
}
const modalProfile = document.querySelector("#modalProfile");
function modalProfilefn()
{
    modalProfile.classList.toggle('hidden');
    modalProfile.classList.toggle('flex');
}
const modalPassword = document.querySelector("#modalPassword");
function modalPasswordfn()
{
    modalPassword.classList.toggle('hidden');
    modalPassword.classList.toggle('flex');
}
