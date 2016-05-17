<?php if(!defined('KIRBY')) exit ?>

title: Blog Post
pages: false
files: true
fields:
  title:
    label: Title
    type:  text
    width: 1/2
  author:
    label: Author
    type: tags
    icon: user
    width: 1/2
  date:
    label: Publish Date
    type: date
    format: MM/DD/YYYY
    width: 1/4
  time:
    label: Publish Time
    type: time
    width: 1/4
  cover:
    label: Cover Image
    type: image
    width: 1/2
  text:
    label: Start writing, fucko!
    type: markdown
  tags:
    label: Tags
    lowercase: true
    type: tags