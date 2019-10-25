#vettore parametri di default di Miranda
#vett_def=['score', 'energy', 'strict', 'noenergy']
vett_def=['140','1','off','off']

#creazione vettore dei parametri inseriti dall'utente
vett_par=[]

#creazione vettore che verrà passato a Miranda
vett_out=[]

#options.dat contiene i parametri
file=open("uploads/options.dat","r")
line=file.readline().chomp.split("\t")


line.size.times{|j|
	vett_par.push(line[j])

}

vett_def.size.times{|i|
	if vett_par[i]!=nil
		vett_out[i]=vett_par[i]
	else
		vett_out[i]=vett_def[i]
	end

}

miranda = "miranda uploads/input.fasta database/reduced_database.dat -out database/out.txt "


	if vett_par[2]=='on' && vett_par[3]=='on'
		miranda.concat("-sc #{vett_out[0]} -en #{vett_out[1]} -strict -noenergy")
	elsif vett_par[2]=='on'
		miranda.concat("-sc #{vett_out[0]} -en #{vett_out[1]} -strict")
	elsif vett_par[3]=='on'
		miranda.concat("-sc #{vett_out[0]} -en #{vett_out[1]} -noenergy")
	else vett_par[2]!='on' && vett_par[3]!='on'
		miranda.concat("-sc #{vett_out[0]} -en #{vett_out[1]}")
	end
	

exec miranda