// Création du tableau : paramètre utilisateur
var tfConfig = {
   base_path: '../../TableFilter-master/dist/tablefilter/',
   alternate_rows: true,
   rows_counter: {
       text: 'Résultats: '
   },
   btn_reset: {
       text: 'Reset les filtrages'
   },
   clear_filter_text: 'Tous',
   loader: true,
   no_results_message: true,
   col_1: 'select',
   col_2: 'select',
   col_types: [
      'string',
      'string',
      'string',
   ],
   extensions: [{ name: 'sort' }]
};

// Localisation du tableau
var tf = new TableFilter(document.querySelector('#adimin-table'), tfConfig);
tf.init();

