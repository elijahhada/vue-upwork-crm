document.querySelector('.open-take').addEventListener('click', () => {
    document.getElementById('take').classList.remove('hidden');
    document.querySelector('.container').classList.add('bg-white', 'opacity-40');
});
//close modal press cancel
document.querySelector('.close-take').addEventListener('click', () => {
    document.getElementById('take').classList.add('hidden');
    document.querySelector('.container').classList.remove('bg-white', 'opacity-40');
});
//technologies menu open -- close
document.querySelector('.open-drop-tech-menu').addEventListener('click', () => {
    document.querySelector('.open-drop-tech-menu').classList.toggle('rotate-180');
    document.querySelector('.open-drop-tech-menu').classList.toggle('transform');
    document.querySelector('.drop-menu-technologies').classList.toggle('hidden');
});
// technologies select
const techArr = document.querySelectorAll('.tech-button');
for (let i = 0; i < techArr.length; i++) {
    techArr[i].addEventListener('click', (e) => {
        let dopClass = e.currentTarget.getElementsByTagName('span')[0].classList[0];
        let text = e.currentTarget.getElementsByTagName('span')[0].innerHTML;
        let newTechToList = document.createElement('p');
        newTechToList.classList.add('p-1', 'rounded-sm', 'm-1', 'cursor-pointer', 'parent-button', dopClass);
        newTechToList.innerHTML = `${text} ×`;
        document.querySelector('.parent-tech').append(newTechToList);
        parButtons = document.querySelectorAll('.parent-button');
    });
}
// delete buttons from input
document.querySelector('.parent-tech').addEventListener('click', (e) => {
    if (e.target.classList.contains('parent-button')) {
        e.target.classList.add('need-to-delete');
        setTimeout(() => {
            document.querySelector('.need-to-delete').remove();
        }, 40);
    }
});

// open big calendar
document.querySelector('.open-big-calendar').addEventListener('click', () => {
    document.getElementById('big-calendar').classList.toggle('hidden');
});
//close big-calendar
document.querySelector('.close-big-calendar').addEventListener('click', () => {
    document.getElementById('big-calendar').classList.toggle('hidden');
});

// top menu dropdown menu show-close
// document.querySelector(".link-image").addEventListener("click", () => {
//     document.querySelector('.dropdown').classList.toggle('hidden')
// })

//open-filters
const filterButton = document.querySelectorAll('.open-filters');
for (let x = 0; x < filterButton.length; x++) {
    filterButton[x].addEventListener('click', () => {
        document.getElementById('manager-filters').classList.toggle('hidden');
        document.getElementById('manager-filters').classList.add('z-50', 'absolute', 'top-0', 'left-0', 'right-0');
    });
}

document.querySelector('.close-manager-filters').addEventListener('click', () => {
    document.getElementById('manager-filters').classList.toggle('hidden');
    document.getElementById('manager-filters').classList.remove('z-50', 'absolute', 'top-0', 'left-0', 'right-0');
});

// search block show-hide input
// document.querySelector(".search").addEventListener("click", () => {
//     document.querySelector('.search-block').classList.remove('w-0')
//     document.querySelector('.search-block').classList.add('w-full')
//     document.querySelector('.search-block').style.cssText = 'animation: width100 .3s linear'
//     setTimeout(() => {

//         document.querySelector('.search-block').classList.add('w-full')
//     }, 280)

//     document.querySelector('.parent-search-block').classList.remove('w-6/12')
//     document.querySelector('.parent-search-block').classList.add('w-full')
//     document.querySelector('.block-kit').classList.remove('w-6/12')
//     document.querySelector('.block-kit').classList.add('w-0', 'overflow-hidden')

//     document.querySelector('.search').classList.add('hidden')

// })

// document.querySelector('.search-button').addEventListener("click", () => {
//     // document.querySelector('.search-block').classList.add('hidden')

//     document.querySelector('.search-block').style.cssText = 'animation: width0 .3s linear'
//     setTimeout(() => {
//         document.querySelector('.search-block').classList.remove('w-full')
//         document.querySelector('.search-block').classList.add('w-0')
//         document.querySelector('.search').classList.remove('hidden')

//         document.querySelector('.parent-search-block').classList.remove('w-full')
//         document.querySelector('.parent-search-block').classList.add('w-6/12')
//         document.querySelector('.block-kit').classList.remove('w-0', 'overflow-hidden')
//         document.querySelector('.block-kit').classList.add('w-6/12')
//     }, 280)

// })
// fill search image

document.querySelector('.search').addEventListener('mouseover', () => {
    document.querySelector('#search-svg').style.fill = '#4EA52F';
});
document.querySelector('.search').addEventListener('mouseout', () => {
    document.querySelector('#search-svg').style.fill = 'black';
});
//top menu add shadow on scroll
document.addEventListener('scroll', () => {
    if (pageYOffset > 1) {
        document.querySelector('.topmenu').classList.add('shadow-xl');
    } else {
        document.querySelector('.topmenu').classList.remove('shadow-xl');
    }
});

// calendar hide-show
document.querySelector('.calendar-switcher').addEventListener('mouseover', () => {
    document.querySelector('#right-arrow-55').style.fill = '#4EA52F';
    // document.querySelector(".calendar-switcher").src='images/arrow-right-green.svg'
});
document.querySelector('.calendar-switcher').addEventListener('mouseout', () => {
    document.querySelector('#right-arrow-55').style.fill = 'black';
});

let flag2 = true;
document.querySelector('.calendar-switcher').addEventListener('click', () => {
    if (flag2) {
        document.querySelector('.calendar-block').style.cssText = 'animation: width0 .3s linear;';
        setTimeout(() => {
            document.querySelector('.calendar').classList.add('hidden');
            document.querySelector('.calendar-switcher').classList.add('right-4');
            document.querySelector('.calendar-switcher').style.cssText = 'transform: rotate(180deg)';
        }, 280);
        document.querySelector('.calendar-block').classList.toggle('z-40');

        document.querySelector('.calendar-switcher').classList.remove('-ml-5');

        document.querySelector('.calendar-date').classList.toggle('hidden');
        document.querySelector('.calendar-button').classList.toggle('hidden');
        // add to top menu full width
        document.querySelector('.topmenu').classList.toggle('z-50');
        document.querySelector('.topmenu').querySelector('.last-block').classList.remove('w-3/12');
        document.querySelector('.topmenu').querySelector('.last-block').classList.add('w-0');
        document.querySelector('.topmenu').querySelector('.user-block').classList.remove('w-5/12');
        document.querySelector('.topmenu').querySelector('.user-block').classList.add('w-8/12');
        flag2 = !flag2;
    } else {
        document.querySelector('.calendar-block').style.cssText = 'animation: width100 .3s linear;';

        document.querySelector('.calendar').classList.remove('hidden');

        document.querySelector('.calendar-block').classList.toggle('z-40');
        setTimeout(() => {
            document.querySelector('.calendar-switcher').style.cssText = 'transform: rotate(0deg)';
        }, 280);
        document.querySelector('.calendar-switcher').classList.remove('right-4');
        document.querySelector('.calendar-switcher').classList.add('-ml-5');
        document.querySelector('.calendar-date').classList.toggle('hidden');
        document.querySelector('.calendar-button').classList.toggle('hidden');
        // delete from top menu full width
        document.querySelector('.topmenu').classList.toggle('z-50');
        document.querySelector('.topmenu').querySelector('.last-block').classList.add('w-3/12');
        document.querySelector('.topmenu').querySelector('.last-block').classList.remove('w-0');
        document.querySelector('.topmenu').querySelector('.user-block').classList.add('w-5/12');
        document.querySelector('.topmenu').querySelector('.user-block').classList.remove('w-8/12');
        flag2 = !flag2;
    }
});
//// active buttons add-remove new class on click
const activeButtons = document.querySelectorAll('.active-button');
for (let i = 0; i < activeButtons.length; i++) {
    activeButtons[i].addEventListener('click', (e) => {
        if (e.currentTarget.classList.contains('bg-green-500') && e.currentTarget.classList.contains('text-white')) {
            e.currentTarget.classList.remove('bg-green-500');
            e.currentTarget.classList.remove('text-white');
        } else {
            e.currentTarget.classList.add('bg-green-500');
            e.currentTarget.classList.add('text-white');
        }
    });
}
// exception words  delete
const deleteWords = document.querySelectorAll('.exception-words');
for (let i = 0; i < deleteWords.length; i++) {
    deleteWords[i].addEventListener('click', (e) => {
        e.target.parentNode.remove();
    });
}
// open input for new words
document.querySelector('.add-word').addEventListener('click', () => {
    document.querySelector('.add-word').classList.add('hidden');
    document.querySelector('.input-word').classList.remove('hidden');
    document.querySelector('.close-word-input').classList.remove('hidden');
    document.querySelector('.save-word-input').classList.remove('hidden');
});
document.querySelector('.close-word-input').addEventListener('click', () => {
    document.querySelector('.add-word').classList.remove('hidden');
    document.querySelector('.input-word').classList.add('hidden');
    document.querySelector('.close-word-input').classList.add('hidden');
    document.querySelector('.save-word-input').classList.add('hidden');
});
// open-close Kit window
document.querySelector('.create-kid').addEventListener('click', () => {
    document.querySelector('#create-kit').classList.remove('hidden');
    document.querySelector('#create-kit').classList.add('z-50', 'absolute', 'top-0', 'left-0', 'right-0');
});
document.querySelector('.close-kit').addEventListener('click', () => {
    document.querySelector('#create-kit').classList.add('hidden');
    document.querySelector('#create-kit').classList.remove('z-50', 'absolute', 'top-0', 'left-0', 'right-0');
});

// calendar to-book ---- to-delete
const toDelete = document.querySelectorAll('.to-delete');
for (let i = 0; i < toDelete.length; i++) {
    toDelete[i].addEventListener('mouseover', (e) => {
        e.currentTarget.querySelector('.delete-me').classList.toggle('hidden');
    });
}
for (let i = 0; i < toDelete.length; i++) {
    toDelete[i].addEventListener('mouseout', (e) => {
        e.currentTarget.querySelector('.delete-me').classList.toggle('hidden');
    });
}

const toBook = document.querySelectorAll('.to-book');
for (let i = 0; i < toBook.length; i++) {
    toBook[i].addEventListener('mouseover', (e) => {
        e.currentTarget.querySelector('.book-me').classList.toggle('hidden');
    });
}

for (let i = 0; i < toBook.length; i++) {
    toBook[i].addEventListener('mouseout', (e) => {
        e.currentTarget.querySelector('.book-me').classList.toggle('hidden');
    });
}

const deleteMe = document.querySelectorAll('.delete-me');
for (let i = 0; i < deleteMe.length; i++) {
    deleteMe[i].addEventListener('click', (e) => {
        alert('Delete this note');
    });
}
const bookMe = document.querySelectorAll('.book-me');
for (let i = 0; i < bookMe.length; i++) {
    bookMe[i].addEventListener('click', (e) => {
        alert('Book this note');
    });
}
