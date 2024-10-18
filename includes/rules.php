<?php

$register_rules =  [
  'last-name' => [
    'required' => 'The last name field is required.',
    'min:2' => 'The last name must be at least 2 characters.'
  ],
  'first-name' => [
    'required' => 'The first name field is required.',
    'min:2' => 'The first name must be at least 2 characters.'
  ],
  // 'name-extension' => [
  //   'required' => 'The name extension field is required.',
  //   'min:2' => 'The name extension must be at least 2 characters.'
  // ],
  'middle-name' => [
    'required' => 'The middle name field is required.',
    'min:2' => 'The middle name must be at least 2 characters.'
  ],
  'hei-name' => [
    'required' => 'The HEI name field is required.',
    'min:2' => 'The HEI name must be at least 2 characters.'
  ],
  'type-of-hei' => [
    'required' => 'The Type of HEI field is required.',
    'min:2' => 'The Type of HEI must be at least 2 characters.'
  ],
  'address-province' => [
    'required' => 'The address province field is required.',
    'min:2' => 'The address province must be at least 2 characters.'
  ],
  'birthday' => [
    'required' => 'The birthday field is required.',
    'date' => 'The birthday must be a valid date.'
  ],
  'gender' => [
    'required' => 'The gender field is required.'
  ],
  'address-street-barangay' => [
    'required' => 'The address street barangay field is required.',
    'min:2' => 'The address street barangay must be at least 2 characters.'
  ],
  'address-municipality' => [
    'required' => 'The address municipality field is required.',
    'min:2' => 'The address municipality must be at least 2 characters.'
  ],
  'address-province' => [
    'required' => 'The address province field is required.',
    'min:2' => 'The address province must be at least 2 characters.'
  ],
  'region' => [
    'required' => 'The region field is required.',
  ],
  'civil-status' => [
    'required' => 'The civil status field is required.'
  ],
  'religion' => [
    'required' => 'The religion field is required.'
  ],
  'email' => [
    'required' => 'The email field is required.',
    'min:2' => 'The email must be at least 2 characters.',
    'email' => 'The email must be a valid email address.'
  ],
  'contact-number' => [
    'required' => 'The contact number field is required.',
    'min:11' => 'The contact number must be exactly 11 numbers.',
    'max:11' => 'The contact number must be exactly 11 numbers.',
    'numeric' => 'The contact number must be a valid number.'
  ],
  'college' => [
    'required' => 'The college field is required.'
  ],
  'year-level' => [
    'required' => 'The year level field is required.'
  ],
  'course' => [
    'required' => 'The course field is required.',
    'min:2' => 'The course must be at least 2 characters.'
  ],
  'major' => [
    'required' => 'The major field is required.',
    'min:2' => 'The major must be at least 2 characters.'
  ],
  'contact-person-name' => [
    'required' => 'The contact person name field is required.',
    'min:2' => 'The contact person name must be at least 2 characters.'
  ],
  'contact-person-number' => [
    'required' => 'The contact person number field is required.',
    'min:11' => 'The contact person number must be exactly 11 numbers.',
    'max:11' => 'The contact person number must be exactly 11 numbers.',
    'numeric' => 'The contact person number must be a valid number.'
  ],
  'student-type' => [
    'required' => 'The nstp component field is required'],
];


$edit_rules =  [
  'graduation-year' => [
    'required' => 'The graduation year field is required.',
    'min:2' => 'The graduation year must be at least 2 characters.'
  ],
  'serial-number' => [
    'required' => 'The serial number field is required.',
    'min:2' => 'The serial number must be at least 2 characters.'
  ],
  'last-name' => [
    'required' => 'The last name field is required.',
    'min:2' => 'The last name must be at least 2 characters.'
  ],
  'first-name' => [
    'required' => 'The first name field is required.',
    'min:2' => 'The first name must be at least 2 characters.'
  ],
  // 'name-extension' => [
  //   'required' => 'The name extension field is required.',
  //   'min:2' => 'The name extension must be at least 2 characters.'
  // ],
  'middle-name' => [
    'required' => 'The middle name field is required.',
    'min:2' => 'The middle name must be at least 2 characters.'
  ],
  'hei-name' => [
    'required' => 'The HEI name field is required.',
    'min:2' => 'The HEI name must be at least 2 characters.'
  ],
  'type-of-hei' => [
    'required' => 'The Type of HEI field is required.',
    'min:2' => 'The Type of HEI must be at least 2 characters.'
  ],
  'birthday' => [
    'required' => 'The birthday field is required.',
    'date' => 'The birthday must be a valid date.'
  ],
  'gender' => [
    'required' => 'The gender field is required.'
  ],
  'address-street-barangay' => [
    'required' => 'The address street barangay field is required.',
    'min:2' => 'The address street barangay must be at least 2 characters.'
  ],
  'address-municipality' => [
    'required' => 'The address municipality field is required.',
    'min:2' => 'The address municipality must be at least 2 characters.'
  ],
  'address-province' => [
    'required' => 'The address province field is required.',
    'min:2' => 'The address province must be at least 2 characters.'
  ],
  'region' => [
    'required' => 'The region field is required.',
    'min:2' => 'The region must be at least 2 characters.'
  ],
  'civil-status' => [
    'required' => 'The civil status field is required.'
  ],
  'religion' => [
    'required' => 'The religion field is required.'
  ],
  'email' => [
    'required' => 'The email field is required.',
    'min:2' => 'The email must be at least 2 characters.',
    'email' => 'The email must be a valid email address.'
  ],
  'contact-number' => [
    'required' => 'The contact number field is required.',
    'min:11' => 'The contact number must be exactly 11 numbers.',
    'max:11' => 'The contact number must be exactly 11 numbers.',
    'numeric' => 'The contact number must be a valid number.'
  ],
  'college' => [
    'required' => 'The college field is required.'
  ],
  'year-level' => [
    'required' => 'The year level field is required.'
  ],
  'course' => [
    'required' => 'The course field is required.',
    'min:2' => 'The course must be at least 2 characters.'
  ],
  'major' => [
    'required' => 'The major field is required.',
    'min:2' => 'The major must be at least 2 characters.'
  ],
  'contact-person-name' => [
    'required' => 'The contact person name field is required.',
    'min:2' => 'The contact person name must be at least 2 characters.'
  ],
  'contact-person-number' => [
    'required' => 'The contact person number field is required.',
    'min:11' => 'The contact person number must be exactly 11 numbers.',
    'max:11' => 'The contact person number must be exactly 11 numbers.',
    'numeric' => 'The contact person number must be a valid number.'
  ],
];
