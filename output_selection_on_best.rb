#con linux sono stati selezionati i primi 100 (come esempio) allineamenti migliori in base allo Score
#l'output consiste in una lista con score descrescente
#il file è stato nominato "best.txt"
#da qui occorre prendere il contenuto dei confronti (allineamento, parametri vari ecc) dal file di output di Miranda (out.txt)

#COMANDO LINUX
#cat out.txt | grep -A 1 "Scores for this hit:"| sort -k 3 | grep '>' |  'cut -f1-2' | sed "s/\t/ vs /g | tac | head -n 100 | tee database/best.txt

#CONVERSIONE DEL COMANDO LINUX IN RUBY

system 'cat database/out.txt' '|' 'grep -A 1 "Scores for this hit:"''|' 'sort -k 3 ''|' 'grep ">" ''|' 'cut -f1-2' '|' 'sed "s/\t/ vs /g" ''|' 'tac' '|' 'head -n 100' '|' 'tee database/best.txt'''


f = open("database/best.txt").readlines()

v=[]
for line in f
  v.push(line[1..-2])	#togliendo il ">" iniziale e l'ultimo spazio vuoto
end


#utilizzo di espressione regolare per fare il match tra i migliori risultati e l'output di Miranda
#l'espressione regolare prende due stringhe


#conversione della stringa "nomi della coppia" in espressione regolare

reg = Regexp.union(v.reject(&:empty?))

printing = false

selection=open("database/selection.txt", "w")

File.open("database/out.txt").each_line do |line|
	printing = true if line =~ reg 
  	selection.write(line) if printing
  	printing = false if line =~ /Complete/
end