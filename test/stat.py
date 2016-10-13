total = 0
for i in range(int(open('all_test_results/amount.txt').read())):
    content = open('all_test_results/test_result_' + str(i+1) + '.txt').read()
    line = content.find('Total: ')
    score = content[line+7:content.find("/", line)]
    if i % 10 == 0:
        print('\n' + str(i) + '\t', end='')
    print(str(score) + '\t', end='')
    total += int(score)
print('\nTotal: ' + str(i + 1) + '; average: ' + str(total / (i + 1)))

