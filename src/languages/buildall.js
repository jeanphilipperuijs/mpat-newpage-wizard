/**
 * For testing purposes.
 *
 * Merge language opbject and export the results in a file
 *
 * @author Jean-Philippe Ruijs
 */
const Merge2File = require('merger');
const de = require('./org/de');
const es = require('./org/es');
const fi = require('./org/fi');
const fr = require('./org/fr');
const it = require('./org/it');
const nl = require('./org/nl');
const en = require('./org/en');
const exportpath = '/home/jpruijs/git/mpat-newpage-wizard/src/languages/export';
let m = new Merge2File('de', de, en, exportpath);
m.save();
m=null;

m = new Merge2File('es', es, en, exportpath);
m.save();
m=null;

m = new Merge2File('fi', fi, en, exportpath);
m.save();
m=null;

m = new Merge2File('fr', fr, en, exportpath);
m.save();
m=null;

m = new Merge2File('it', it, en, exportpath);
m.save();
m=null;

m = new Merge2File('nl', nl, en, exportpath);
m.save();

