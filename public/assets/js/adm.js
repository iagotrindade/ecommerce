function confirmDel(e) {
    return confirm(e);
}

//OPEN PRODUCTS MENU

if(document.querySelector('#toggle-dropdown-menu-action') !== null) {
    let menuToggle = document.querySelector('#toggle-dropdown-menu-action');

    menuToggle.addEventListener('click', (e) => {
        e.preventDefault();

        if(document.querySelector('.dropdown-menu-items-area').style.display != 'flex') {

            document.querySelector('.dropdown-menu-items-area').style.display = 'flex';

            document.querySelectorAll('#toggle-dropdown-menu-action i, #toggle-dropdown-menu-action p').forEach(element => {
                element.style.color = '#5041BC'
            });

            menuToggle.style.backgroundColor = '#FFFFFF';

            menuToggle.style.borderRadius = "9px 9px 0 0";
        }

        else {
            document.querySelector('.dropdown-menu-items-area').style.display = 'none';

            document.querySelectorAll('#toggle-dropdown-menu-action i, #toggle-dropdown-menu-action p').forEach(element => {
                element.style.color = ''
            });

            menuToggle.style.backgroundColor = '';

            menuToggle.style.borderRadius = "9px";
        }
    });
}

//OPEN NOTIFICATION BAR

if(document.querySelector('#toggle-notification-bar') !== null) {
    document.querySelector('#toggle-notification-bar').addEventListener('click', () => {
        if(document.querySelector('.notification-list-area').style.display === 'none') {
            document.querySelector('.notification-list-area').style.display = 'flex';
        }

        else {
            document.querySelector('.notification-list-area').style.display = 'none';
        }
    })
}


//SEARCH ORDER SCRIPT

if(document.querySelectorAll('.order-number')) {
    let item = document.querySelectorAll('.order-number');

    document.getElementById('search').addEventListener("keyup", function () {

        var term = document.getElementById('search').value.toLowerCase();
        var find = false;
        var show = [];

        for(var i = 0; i < item.length; i++) {
            var value = item[i].childNodes[0].nodeValue.toLowerCase();

            if(value.indexOf(term) >= 0) {
                show.push(item[i].closest("#order-item"));
                find = true;
            }

        }

        if(find) {
            for(var i = 0; i < item.length; i++) {
                item[i].closest("#order-item").style.display = 'none';
            }

            for(var i = 0; i < show.length; i++) {
                show[i].closest("#order-item").style.display = 'table-row';
                }
            }

            else {
                for(var i = 0; i < item.length; i++) {
                item[i].closest("#order-item").style.display = 'none';
            }
        }
    })
}


//FILTER ORDER SCRIPT

let filters = document.querySelectorAll('.status-filter-item');

filters.forEach(element => {
    element.addEventListener('click', () => {
        switch (element.innerHTML) {
            case "Todos":
                document.querySelector('.status-filter-item-active').classList.remove("status-filter-item-active");
                element.classList.add("status-filter-item-active");
                showAllOrders()
                break;

            case "Não Processados":
                document.querySelector('.status-filter-item-active').classList.remove("status-filter-item-active");
                element.classList.add("status-filter-item-active");

                hideAllOrders()

                document.querySelectorAll("#processing-status").forEach(e => {
                    if(e.childNodes[1].innerHTML === "Não Processado") {

                        e.parentElement.style.display = 'table-row';
                    }
                });
                break;


            case "Processados":
                document.querySelector('.status-filter-item-active').classList.remove("status-filter-item-active");
                element.classList.add("status-filter-item-active");

                hideAllOrders()

                document.querySelectorAll("#processing-status").forEach(e => {
                    if(e.childNodes[1].innerHTML === "Processado") {

                        e.parentElement.style.display = 'table-row';
                    }
                });
                break;

            case "Pendentes":
                document.querySelector('.status-filter-item-active').classList.remove("status-filter-item-active");

                element.classList.add("status-filter-item-active");

                hideAllOrders()

                document.querySelectorAll("#payment-status").forEach(e => {
                    if(e.childNodes[1].innerHTML === "Pendente") {
                        e.parentElement.style.display = 'table-row';
                    }
                });
                break;

            case "Cancelados":
                document.querySelector('.status-filter-item-active').classList.remove("status-filter-item-active");

                hideAllOrders()

                element.classList.add("status-filter-item-active");
                document.querySelectorAll("#payment-status").forEach(e => {
                    if(e.childNodes[1].innerHTML === "Cancelado") {
                        e.parentElement.style.display = 'table-row';
                    }
                });
                break;

            default:
                break;
        }
    })
});


//FILTER CITY SCRIPT

if(document.querySelector('#city-filter-item') != null) {
    document.querySelector('#city-filter-item').addEventListener('change', (element) => {
        var item = document.querySelectorAll('[data-city]');

        var term = element.srcElement.selectedOptions[0].value.toLowerCase();
        var find = false;
        var show = [];

        for(var i = 0; i < item.length; i++) {
            var value = item[i].dataset.city.toLowerCase();

            if(value.indexOf(term) >= 0) {
                show.push(item[i].closest("#order-item"));
                find = true;
            }
        }

        if(find) {
            for(var i = 0; i < item.length; i++) {
                item[i].closest("#order-item").style.display = 'none';
            }

            for(var i = 0; i < show.length; i++) {;
                show[i].closest("#order-item").style.display = 'table-row';
            }
        }

        else if(term === 'default') {
            for(var i = 0; i < item.length; i++) {
                item.forEach(element => {
                    element.style.display = 'table-row';
                })
            }
        }

        else {
            for(var i = 0; i < item.length; i++) {
            item[i].closest("#order-item").style.display = 'none';
        }
    }})

    function showAllOrders() {
        document.querySelectorAll("#order-item").forEach(e => {
            e.style.display = 'table-row';
        });
    }

    function hideAllOrders() {
        document.querySelectorAll("#order-item").forEach(e => {
            e.style.display = 'none';
        });
    }
}


//OPEN ADD IMAGE MODAL

if(document.querySelector('#add-image') != null) {
    document.querySelector('#add-image').addEventListener('click', () => {
        let modal = document.querySelector('.add-image-modal');

        modal.style.opacity = 0;

        modal.style.display = "flex";

        setTimeout(() => {
            modal.style.opacity = 1;
        }, 0.7);
    })

    document.querySelector('#close-modal').addEventListener('click', () => {
        let modal = document.querySelector('.add-image-modal');
        modal.style.opacity = 1;

        modal.style.display = "none";

        setTimeout(() => {
            modal.style.opacity = 0;
        }, 0.7);
    })

    //UPLOAD IMAGES SCRIPT

    document.querySelector('#upload-image-button').addEventListener('click', () => {

        let imageInput = document.querySelector('#image-input');
        let sendButton = document.querySelector('#send-image-button');
        let archiveText = document.querySelector('#upload-image-button');

        imageInput.click();

        imageInput.addEventListener('change', (e) => {
            if(imageInput.value != '') {
                archiveText.innerHTML = imageInput.files[0].name+' Carregado';

                sendButton.style.display = 'flex';
            }

            else {
                sendButton.style.display = 'none';
                archiveText.innerHTML = 'Clique aqui para fazer o Upload';
            }
        })
    })

    //DELETE IMAGES SCRIPT

    checkboxList = document.querySelectorAll('#delete-checkbox');

    checkboxList.forEach(element => {
        element.addEventListener('change', () => {
            if(element.checked === true ) {
                element.parentElement.parentElement.style.backgroundColor = '#C5E3FF';
            }

            else {
                element.parentElement.parentElement.style.backgroundColor = '#FFFFFF';
            }
    })

    })

    document.querySelectorAll('.delete-image-area').forEach(element => {
        element.addEventListener('click', () => {

            document.querySelectorAll('#delete-checkbox').forEach(e => {
                if(e.checked !== true) {
                    e.nextElementSibling.name = "";
                }
            });
        })
    })

    function deleteImages() {
        setTimeout(() => {
            document.querySelector('#delete-form').submit();
        }, 100);
    }


    //FILTER IMAGES BY DATE

    document.querySelector('#date-filter').addEventListener('change', () => {
        let imagesBox = document.querySelectorAll('.image-box');

        let newOrder = [];

        imagesBox.forEach(element => {
            newOrder.push(element.outerHTML);
        });

        newOrder.reverse();

        imagesBox.forEach(element => {
            element.parentNode.removeChild(element);
        });

        newOrder = newOrder.join("");

        document.querySelector('#delete-form').innerHTML = newOrder;

        document.querySelectorAll('.delete-image-area').forEach(element => {
            element.addEventListener('click', () => {

                document.querySelectorAll('#delete-checkbox').forEach(e => {
                    if(e.checked !== true) {
                        e.nextElementSibling.name = "";
                    }
                });
            })
        })
    })
}



//FILTER USER SCRIPT

if(document.querySelectorAll('.users-filter-button') !== null) {
    let userFilters = document.querySelectorAll('.users-filter-button');

    userFilters.forEach(element => {
        element.addEventListener('click', () => {
            switch (element.innerHTML) {
                case "Todos":
                    document.querySelector('.users-filter-active').classList.remove("users-filter-active");
                    element.classList.add("users-filter-active");

                    showAllUsers()

                    break;

                case "Administrador":
                    document.querySelector('.users-filter-active').classList.remove("users-filter-active");
                    element.classList.add("users-filter-active");

                    hideAllUsers()

                    document.querySelectorAll("#user-permission").forEach(e => {

                        console.log(e.innerHTML);
                        if(e.innerHTML === "Administrador") {
                            e.parentElement.style.display = 'table-row';
                        }
                    });
                    break;


                case "Cadastro":
                    document.querySelector('.users-filter-active').classList.remove("users-filter-active");
                    element.classList.add("users-filter-active");

                    hideAllUsers()

                    document.querySelectorAll("#user-permission").forEach(e => {
                        if(e.innerHTML === "Cadastro") {
                            e.parentElement.style.display = 'table-row';
                        }
                    });
                    break;

                case "Ativados":
                    document.querySelector('.users-filter-active').classList.remove("users-filter-active");
                    element.classList.add("users-filter-active");

                    hideAllUsers()

                    document.querySelectorAll("#user-status").forEach(e => {

                        console.log(e.innerHTML);
                        if(e.innerHTML === "Ativado") {
                            e.parentElement.parentElement.style.display = 'table-row';
                        }
                    });
                    break;
            }
        })
    });


    function showAllUsers() {
        document.querySelectorAll("#user-item").forEach(e => {
            e.style.display = 'table-row';
        });
    }

    function hideAllUsers() {
        document.querySelectorAll("#user-item").forEach(e => {
            e.style.display = 'none';
        });
    }
}


//SEARCH USER SCRIPT

if(document.querySelectorAll('#user-name')) {
    var item = document.querySelectorAll('#user-name');

    document.getElementById('search').addEventListener("keyup", function () {

        var term = document.getElementById('search').value.toLowerCase();
        var find = false;
        var show = [];

        for(var i = 0; i < item.length; i++) {
            var value = item[i].childNodes[0].nodeValue.toLowerCase();

            if(value.indexOf(term) >= 0) {
                show.push(item[i].closest("#user-name"));
                find = true;
            }
        }

        if(find) {
            for(var i = 0; i < item.length; i++) {

                item[i].parentElement.style.display = 'none';
            }

            for(var i = 0; i < show.length; i++) {
                console.log(show[i]);
                show[i].parentElement.style.display = 'table-row';
                }
            }

            else {
                for(var i = 0; i < item.length; i++) {
                item[i].parentElement.style.display = 'none';
            }
        }
    })
}

//OPEN ADD USER MODAL

if(document.querySelector(".add-user-button")) {
    let usersModal = document.querySelector('.users-modal-area');
    let usersModalFilter = document.querySelector('.modal-filter');

    document.querySelector(".add-user-button").addEventListener('click', () => {

        usersModal.style.opacity = 0;
        usersModal.style.display = "initial";

        usersModalFilter.style.opacity = 0;
        usersModalFilter.style.display = "block";

        setTimeout(() => {
            usersModalFilter.style.opacity = 0.5;
            usersModal.style.opacity = 1;
        },2);
    })

    //CLOSE ADD USER MODAL

    document.querySelector('#close-add-user-modal-button').addEventListener('click', (e) => {
        e.preventDefault();

        usersModalFilter.style.opacity = 0;
        usersModal.style.opacity = 0;

        usersModal.style.display = "none";
        usersModalFilter.style.display = "none";
    })

    //CHANGE ADD USER PERMISSION VALUE
    let userPermissionInput = document.querySelector('#user-permission-input');

    document.querySelectorAll('.permission-item').forEach(element => {
        element.addEventListener('click', () => {

            userPermissionInput.value = element.attributes['data-id'].value;

            if(document.querySelector('.permission-active') !== null) {
                document.querySelector('.permission-active').classList.remove('permission-active');
            }

            element.classList.add('permission-active');
        })
    });

    //PREVIEW IMAGE SCRIPT
    let userImageInput = document.querySelector('#user-image-input');

    document.querySelector('.upload-user-image-button').addEventListener('click', () => {
        userImageInput.click();

        userImageInput.addEventListener('change', () => {
            if(userImageInput.files.length <= 0) {
                return;
            }

            let reader = new FileReader();

            reader.onload = () => {
                if(reader.result.indexOf('data:video')) {
                    document.querySelector('.user-image-input-area').innerHTML = '<img src="'+reader.result+'" id="user-image-loaded">';
                    document.querySelector('.user-image-input-area').style.padding = '0';
                }
              }

              reader.readAsDataURL(userImageInput.files[0]);
        })
    })

    //OPEN EDIT USER MODAL AND SET USER INFORMATIONS
    let editUsersModal = document.querySelector('.edit-user-modal-area');
    let editUserId = document.querySelector("#edit-user-id-input");
    let deleteUserInput= document.querySelector('#delete-user-input');
    let deleteUserButton = document.querySelector('.delete-user-button');
    let nameInput= document.querySelector('#edit-name-input');
    let usernameInput = document.querySelector('#edit-username-input');
    let phoneInput = document.querySelector('#edit-phone-input');
    let emailInput = document.querySelector('#edit-email-input');
    let userImage = document.querySelector('#edit-image');
    let userPermissionEditInput = document.querySelector('#edit-user-permission-input');
    let userStatusInput = document.querySelector('#edit-user-status-input');

    document.querySelectorAll('#edit-user-button').forEach(element => {
        element.addEventListener('click', () => {

            editUsersModal.style.opacity = 0;
            editUsersModal.style.display = "initial";

            usersModalFilter.style.opacity = 0;
            usersModalFilter.style.display = "block";

            setTimeout(() => {
                usersModalFilter.style.opacity = 0.5;
                editUsersModal.style.opacity = 1;
            },2);

            let user = JSON.parse(element.attributes['data-user'].value);

            editUserId.value = user['id'];

            if(document.querySelector('.permission-active-edit') !== null) {
                document.querySelector('.permission-active-edit').classList.remove('permission-active-edit');
            }

            document.querySelectorAll('.permission-item-edit').forEach(element => {
                if(user['permissionName'] === element.innerText) {
                    element.classList.add('permission-active-edit');

                    userPermissionEditInput.value = element.attributes['data-id'].value;
                }
            });

            if(document.querySelector('.access-permission-active')) {
                document.querySelector('.access-permission-active').classList.remove('access-permission-active');
            }

            document.querySelectorAll('.access-item').forEach(element => {
                if(user['status'] === element.innerText) {
                    element.classList.add('access-permission-active');

                    userStatusInput.value = element.attributes['data-status'].value;
                }
            });

            console.log(user);
            nameInput.value = user['name'];
            usernameInput.value = user['username'];
            phoneInput.value = user['phone'];
            emailInput.value = user['email'];
            userImage.src = 'storage/'+user['image'];

            deleteUserInput.value = user['id'];

            deleteUserButton.addEventListener('click', (e) => {
                e.preventDefault();

                document.querySelector('#delete-user-form').submit();
            })
        })
    });

    //CHANGE EDIT USER PERMISSION VALUE

    document.querySelectorAll('.permission-item-edit').forEach(element => {
        element.addEventListener('click', () => {

            document.querySelector('.permission-active-edit').classList.remove('permission-active-edit');

            userPermissionEditInput.value = element.attributes['data-id'].value;

            element.classList.add('permission-active-edit');
        })
    });


    //CHANGE EDIT USER STATUS VALUE

    document.querySelectorAll('.access-item').forEach(element => {
        element.addEventListener('click', () => {

            document.querySelector('.access-permission-active').classList.remove('access-permission-active');

            userStatusInput.value = element.attributes['data-status'].value;

            element.classList.add('access-permission-active');
        })
    });

    //EDIT USER IMAGE SCRIPT

    let editUserImageInput = document.querySelector('#edit-user-image-input');

    document.querySelector('#edit-image').addEventListener('click', () => {
        editUserImageInput.click();

        editUserImageInput.addEventListener('change', () => {
            if(editUserImageInput.files.length <= 0) {
                return;
            }

            let reader = new FileReader();

            reader.onload = () => {
                if(reader.result.indexOf('data:video')) {
                    document.querySelector('.edit-user-image-input-area').innerHTML = '<img src="'+reader.result+'" id="user-image-loaded">';
                    document.querySelector('.edit-user-image-input-area').style.padding = '0';
                }
              }

              reader.readAsDataURL(editUserImageInput.files[0]);
        })
    })

    //CLOSE EDIT MODAL
    document.querySelector('#close-edit-user-modal-button').addEventListener('click', (e) => {
        e.preventDefault();

        usersModalFilter.style.opacity = 0;
        usersModal.style.opacity = 0;

        editUsersModal.style.display = "none";
        usersModalFilter.style.display = "none";
    })
}


//OPEN ADD PERMISSION MODAL

if(document.querySelector('.add-permission-button') != null) {
    let addPermissionModal = document.querySelector('.add-permission-groups-modal');
    let permissionsModalFilter = document.querySelector('.modal-filter');

    document.querySelector('.add-permission-button').addEventListener('click', () => {
        addPermissionModal.style.opacity = 0;
        addPermissionModal.style.display = "initial";

        permissionsModalFilter.style.opacity = 0;
        permissionsModalFilter.style.display = "block";

        setTimeout(() => {
            permissionsModalFilter.style.opacity = 0.5;
            addPermissionModal.style.opacity = 1;
        },2);
    })

    //CLOSE ADD PERMISSION MODAL

    document.querySelector('#close-permissions-user-modal-button').addEventListener('click', (e) => {
        e.preventDefault();

        permissionsModalFilter.style.opacity = 0;
        addPermissionModal.style.opacity = 0;

        addPermissionModal.style.display = "none";
        permissionsModalFilter.style.display = "none";
    })

    //SELECT PERMISSION ITEMS SCRIPT

    let permissionsListInput = document.querySelector('#permissions-list');
    let permissionList = [];


    document.querySelectorAll('.permissions-permission-item-add').forEach(element => {
        element.addEventListener('click', () => {
            let permissionItemValue = element.attributes['data-value'].value;

            if(element.classList.contains('permission-active-item') === false) {
                element.classList.add('permission-active-item');

                console.log(element.classList.add('permission-active-item'));

                if(permissionList.includes(permissionItemValue) === false) {
                    permissionList.push(permissionItemValue);
                }
            }

            else {
                element.classList.remove('permission-active-item');

                permissionList.splice(permissionList.indexOf(permissionItemValue), 1);
            }

            permissionsListInput.value = permissionList;
        })
    });

    //OPEN EDIT PERMISSION MODAL AND SET PERMISSION INFORMATION

    let editPermissionModal = document.querySelector('.edit-permission-groups-modal');
    let groupIdInput = document.querySelector('#group-id');
    let groupNameInput = document.querySelector('#edit-name');
    let editPermissionsListInput = document.querySelector('#edit-permissions-list');
    let editPermissionList = [];
    let deleteForm = document.querySelector('#delete-form');
    let deleteInput = document.querySelector('#delete-group');
    let deletePermissionButton = document.querySelector('.delete-permission-group-button');

    document.querySelectorAll('#edit-permission-button').forEach(editButton => {

        editButton.addEventListener('click', () => {
            editPermissionModal.style.opacity = 0;
            editPermissionModal.style.display = "initial";

            permissionsModalFilter.style.opacity = 0;
            permissionsModalFilter.style.display = "block";

            setTimeout(() => {
                permissionsModalFilter.style.opacity = 0.5;
                editPermissionModal.style.opacity = 1;
            },2);

            let permissionGroup = JSON.parse(editButton.attributes['data-permissionsItems'].value);

            groupIdInput.value = permissionGroup['id'];

            groupNameInput.value = permissionGroup['name'];

            document.querySelectorAll('.permissions-permission-item').forEach(element => {
                element.classList.remove('permission-active-item');

                permissionGroup['permissionItems'].forEach(e => {
                    if(e['permission_item_id'] == element.attributes['data-value'].value) {
                        element.classList.add('permission-active-item');

                        if(editPermissionList.includes(e['permission_item_id']) === false) {
                            editPermissionList.push(e['permission_item_id']);
                        }
                    }
                });

                editPermissionsListInput.value = editPermissionList;
            });

            deleteInput.value = permissionGroup['id'];

            deletePermissionButton.addEventListener('click', (e) => {
                e.preventDefault();

                deleteForm.submit();

            })

            editPermissionList = [];
        });
    })

    //CHANGE EDIT PERMISSION ITEM SCRIPT

    document.querySelectorAll('.permissions-permission-item').forEach(element => {
        element.addEventListener('click', () => {
            editPermissionList = editPermissionsListInput.value.split(',');

            let permissionItemValue = element.attributes['data-value'].value;

            if(element.classList.contains('permission-active-item') === true) {
                element.classList.remove('permission-active-item');

                editPermissionList.splice(editPermissionList.indexOf(permissionItemValue), 1);
            }

            else {
                element.classList.add('permission-active-item');

                if(editPermissionList.includes(permissionItemValue) === false) {
                    editPermissionList.push(permissionItemValue);
                }
            }
            editPermissionsListInput.value = editPermissionList;
        })
    });

    //CLOSE EDIT PERMISSION MODAL

    document.querySelector('#close-edit-permissions-user-modal-button').addEventListener('click', (e) => {
        e.preventDefault();

        permissionsModalFilter.style.opacity = 0;
        editPermissionModal.style.opacity = 0;

        editPermissionModal.style.display = "none";
        permissionsModalFilter.style.display = "none";
    })
}


