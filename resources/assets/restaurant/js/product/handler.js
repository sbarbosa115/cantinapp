import Tagify from '@yaireo/tagify';

const input = document.querySelector('textarea[name=tags]');
const tagify = new Tagify(input, {
  delimiters: ',',
});

const productHandlerForm = document.querySelector('#form-handler');
productHandlerForm.addEventListener('submit', () => {
  const tags = document.querySelector('#tags');
  const parsedTags = tagify.value.map(tag => tag.value);
  if (parsedTags.length > 0) {
    tags.value = JSON.stringify(parsedTags);
  }
});
